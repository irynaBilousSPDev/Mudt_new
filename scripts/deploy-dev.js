/**
 * Deploy Mudt_new theme via FTP/FTPS.
 * Usage: npm run deploy:dev | npm run deploy:prod
 * Target: node scripts/deploy-dev.js [dev|prod]
 */
const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');
const {
	ROOT,
	loadEnv,
	envFlag,
	cfg,
	normalizeRemotePath,
	connectFtp,
	connectFtpForTarget,
	resetCwd,
	ensureRemoteDir,
	remoteFileSize,
} = require('./ftp-client');

const ENV_FILE = path.join(ROOT, 'deploy.local.env');
const TARGET = (process.argv[2] || 'dev').toLowerCase();

if (TARGET !== 'dev' && TARGET !== 'prod') {
	console.error('Usage: node scripts/deploy-dev.js [dev|prod]');
	process.exit(1);
}

const EXCLUDE_DIR_NAMES = new Set(['node_modules', '.git', '.cursor', 'scripts']);
const EXCLUDE_FILE_NAMES = new Set([
	'deploy.local.env',
	'deploy.local.env.example',
	'.DS_Store',
	'Thumbs.db',
	'.gitignore',
	'.gitattributes',
]);
const EXCLUDE_FILE_BASENAMES = new Set(['package.json', 'package-lock.json']);

const BUILD_OUTPUT_DIR_PREFIX = 'assets/dist/css/';
const BUILD_OUTPUT_FILES = new Set(['assets/dist/js/main.min.js', 'assets/dist/js/main.js']);

function isBuildOutputPath(relativePosix) {
	return (
		relativePosix.startsWith(BUILD_OUTPUT_DIR_PREFIX) ||
		BUILD_OUTPUT_FILES.has(relativePosix)
	);
}

function runAssetBuild(env) {
	if (envFlag(env, 'SKIP_BUILD')) {
		console.log('SKIP_BUILD set — skipping asset build.');
		return;
	}

	console.log('Building assets (npm run build)...');
	execSync('npm run build', { cwd: ROOT, stdio: 'inherit' });
}

function deployGitOnlyEnabled(env) {
	if (envFlag(env, 'DEPLOY_FULL')) return false;
	if (env.DEPLOY_GIT_ONLY !== undefined) return envFlag(env, 'DEPLOY_GIT_ONLY');
	return true;
}

function resolveGitOnlyBaseRef(env) {
	if (env.DEPLOY_GIT_REF) {
		return env.DEPLOY_GIT_REF.trim();
	}
	return TARGET === 'prod' ? 'origin/main' : 'origin/dev';
}

function resolveTrackingBranch() {
	return TARGET === 'prod' ? 'main' : 'dev';
}

function gitRefExists(ref) {
	try {
		execSync(`git rev-parse --verify ${ref}`, { cwd: ROOT, stdio: 'pipe' });
		return true;
	} catch (err) {
		return false;
	}
}

function getGitDeployRelativePaths(env) {
	let files = [];
	const baseRef = resolveGitOnlyBaseRef(env);

	if (gitRefExists(baseRef)) {
		try {
			const ahead = execSync(`git rev-list --count ${baseRef}..HEAD`, {
				cwd: ROOT,
				encoding: 'utf8',
			}).trim();
			if (parseInt(ahead, 10) > 0) {
				files = execSync(`git diff --name-only ${baseRef}..HEAD`, {
					cwd: ROOT,
					encoding: 'utf8',
				})
					.split(/\r?\n/)
					.filter(Boolean);
			}
		} catch (err) {
			// fall through
		}
	}

	if (!files.length) {
		files = execSync('git diff-tree --no-commit-id --name-only -r HEAD', {
			cwd: ROOT,
			encoding: 'utf8',
		})
			.split(/\r?\n/)
			.filter(Boolean);
	}

	return [...new Set(files.filter((f) => !shouldSkip(f)))];
}

function shouldSkip(relativePosix) {
	const parts = relativePosix.split('/');
	for (const part of parts) {
		if (EXCLUDE_DIR_NAMES.has(part)) return true;
		if (part.startsWith('.git')) return true;
	}
	const base = parts[parts.length - 1];
	if (EXCLUDE_FILE_NAMES.has(base) || EXCLUDE_FILE_BASENAMES.has(base)) return true;
	if (base.endsWith('.php4')) return true;
	return false;
}

function walkFiles(dir, baseDir, list) {
	for (const name of fs.readdirSync(dir)) {
		const full = path.join(dir, name);
		const rel = path.relative(baseDir, full).split(path.sep).join('/');
		if (shouldSkip(rel)) continue;
		const stat = fs.statSync(full);
		if (stat.isDirectory()) {
			walkFiles(full, baseDir, list);
		} else {
			list.push({ local: full, relative: rel, size: stat.size });
		}
	}
}

function listDirtyTrackedFiles() {
	const out = execSync('git status --porcelain', { cwd: ROOT, encoding: 'utf8' });
	return out
		.split(/\r?\n/)
		.filter((line) => line.trim())
		.map((line) => line.slice(3).trim().replace(/\\/g, '/'));
}

function assertGitReadyForDeploy(env) {
	if (envFlag(env, 'DEPLOY_ALLOW_DIRTY')) return;

	const dirty = listDirtyTrackedFiles();
	if (dirty.length) {
		const nonBuildDirty = dirty.filter((file) => !isBuildOutputPath(file));
		if (nonBuildDirty.length) {
			throw new Error(
				`Deploy blocked: uncommitted changes (${nonBuildDirty.join(', ')}). Commit first.`
			);
		}
		console.log(
			`Build output not committed (${dirty.join(', ')}) — will still upload fresh CSS/JS.`
		);
	}

	const branch = resolveTrackingBranch();
	const current = execSync('git branch --show-current', { cwd: ROOT, encoding: 'utf8' }).trim();
	if (current !== branch) {
		throw new Error(`Deploy blocked: checkout ${branch} first (current: ${current || 'detached'}).`);
	}

	if (envFlag(env, 'DEPLOY_ALLOW_UNPUSHED')) return;

	const remoteRef = `origin/${branch}`;
	if (!gitRefExists(remoteRef)) {
		return;
	}

	const ahead = execSync(`git rev-list --count ${remoteRef}..HEAD`, {
		cwd: ROOT,
		encoding: 'utf8',
	}).trim();
	if (parseInt(ahead, 10) > 0) {
		throw new Error(
			`Deploy blocked: push remote first (git push) — ${ahead} local commit(s) not on remote yet.`
		);
	}
}

function resolveRemotePath(env) {
	const fallback = TARGET === 'prod'
		? 'httpdocs/wp-content/themes/Mudt_new'
		: 'wp-content/themes/Mudt_new';
	return normalizeRemotePath(cfg(env, TARGET, 'REMOTE_PATH') || fallback);
}

function resolveDeployLabel(env) {
	if (TARGET === 'prod') {
		const secure = String(env.SFTP_PROD_USE_FTPS || '').toLowerCase() === 'true' ? 'FTPS' : 'FTP';
		return `prod → ${cfg(env, 'prod', 'HOST')} (${secure} port ${cfg(env, 'prod', 'PORT') || 21})`;
	}
	return `dev → ${env.SFTP_HOST} (FTP port ${env.SFTP_PORT || 21})`;
}

async function connectDeployClient(env) {
	if (TARGET === 'prod') {
		return connectFtpForTarget(env, 'prod');
	}
	return connectFtp(env);
}

/** Prefer live site files first; docs/src last. */
function deployPhase(relativePosix) {
	if (relativePosix.startsWith('assets/dist/')) return 0;
	if (/\.(php|css)$/i.test(relativePosix) && !relativePosix.startsWith('assets/')) return 1;
	if (relativePosix === 'style.css' || relativePosix === 'functions.php') return 1;
	if (relativePosix.startsWith('inc/') || relativePosix.startsWith('template-parts/') || relativePosix.startsWith('parts/')) return 1;
	if (relativePosix.startsWith('images/')) return 2;
	if (relativePosix.startsWith('assets/src/') || relativePosix.startsWith('configure/')) return 3;
	return 4;
}

function sortFilesForDeploy(files) {
	return [...files].sort((a, b) => {
		const pa = deployPhase(a.relative);
		const pb = deployPhase(b.relative);
		if (pa !== pb) return pa - pb;
		return a.relative.localeCompare(b.relative);
	});
}

function chunkArray(items, size) {
	const chunks = [];
	for (let i = 0; i < items.length; i += size) {
		chunks.push(items.slice(i, i + size));
	}
	return chunks;
}

function sleep(ms) {
	return new Promise((r) => setTimeout(r, ms));
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const dryRun = envFlag(env, 'DRY_RUN');
	const remotePath = resolveRemotePath(env);
	const batchSize = Math.max(5, parseInt(env.DEPLOY_BATCH_SIZE || (TARGET === 'prod' ? '25' : '50'), 10) || 25);
	const batchPauseMs = Math.max(0, parseInt(env.DEPLOY_BATCH_PAUSE_MS || (TARGET === 'prod' ? '2000' : '500'), 10) || 0);

	console.log(`Deploy target: ${resolveDeployLabel(env)}`);
	runAssetBuild(env);
	assertGitReadyForDeploy(env);
	console.log('Git check OK.');

	const gitOnly = deployGitOnlyEnabled(env);
	let files = [];
	walkFiles(ROOT, ROOT, files);

	if (gitOnly) {
		const gitPaths = new Set(getGitDeployRelativePaths(env));
		for (const file of listDirtyTrackedFiles()) {
			if (isBuildOutputPath(file)) {
				gitPaths.add(file);
			}
		}
		const before = files.length;
		files = files.filter((file) => gitPaths.has(file.relative));
		console.log(`Git-only deploy: ${files.length} file(s) (${before} in theme)`);
	} else {
		console.log(`Full deploy: ${files.length} theme file(s)`);
	}

	files = sortFilesForDeploy(files);

	if (!files.length) {
		console.log('Nothing to upload.');
		return;
	}

	if (dryRun) {
		for (const file of files) {
			console.log(`[dry-run] ${file.relative}`);
		}
		return;
	}

	const batches = chunkArray(files, batchSize);
	console.log(`Batched upload: ${batches.length} batch(es) × up to ${batchSize} file(s)`);

	let uploaded = 0;
	let skipped = 0;
	let reconnects = 0;
	const maxReconnects = 30;

	async function uploadOne(activeClient, file) {
		const remoteFile = `${remotePath}/${file.relative}`.replace(/\/+/g, '/');
		await ensureRemoteDir(activeClient, path.posix.dirname(remoteFile));

		const remoteSize = await remoteFileSize(activeClient, remoteFile);
		if (remoteSize === file.size) {
			skipped += 1;
			return;
		}

		process.stdout.write(`↑ ${file.relative}\n`);
		await resetCwd(activeClient);
		await activeClient.uploadFrom(file.local, remoteFile);
		uploaded += 1;
	}

	let client = await connectDeployClient(env);

	try {
		await ensureRemoteDir(client, remotePath);

		for (let bi = 0; bi < batches.length; bi += 1) {
			const batch = batches[bi];
			console.log(`— Batch ${bi + 1}/${batches.length} (${batch.length} file(s)) —`);

			for (const file of batch) {
				let attempts = 0;
				for (;;) {
					try {
						await uploadOne(client, file);
						break;
					} catch (err) {
						const msg = String(err.message || '');
						const retriable = /fin packet|closed|timeout|econnreset|tls|ssl|decode error|socket/i.test(
							msg
						);
						attempts += 1;
						reconnects += 1;
						if (!retriable || reconnects > maxReconnects || attempts > 3) {
							throw err;
						}
						console.log(`Reconnecting (${reconnects}/${maxReconnects})...`);
						try {
							client.close();
						} catch (_) {}
						await sleep(1500 * attempts);
						client = await connectDeployClient(env);
					}
				}
			}

			// Fresh FTPS session between batches (prod Contabo drops long transfers)
			if (bi < batches.length - 1) {
				try {
					client.close();
				} catch (_) {}
				if (batchPauseMs) {
					console.log(`Pause ${batchPauseMs}ms before next batch...`);
					await sleep(batchPauseMs);
				}
				client = await connectDeployClient(env);
			}
		}
	} finally {
		try {
			client.close();
		} catch (_) {}
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}`);
	console.log(`Remote theme: ${remotePath}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
