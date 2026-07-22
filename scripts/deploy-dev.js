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
]);
const EXCLUDE_FILE_BASENAMES = new Set(['package.json', 'package-lock.json']);

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
		throw new Error(`Deploy blocked: uncommitted changes (${dirty.join(', ')}). Commit first.`);
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
			`Deploy blocked: push first (git push origin ${branch}) — ${ahead} commit(s) not on GitHub yet.`
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

async function main() {
	const env = loadEnv(ENV_FILE);
	const dryRun = envFlag(env, 'DRY_RUN');
	const remotePath = resolveRemotePath(env);

	console.log(`Deploy target: ${resolveDeployLabel(env)}`);
	assertGitReadyForDeploy(env);
	console.log('Git check OK.');

	const gitOnly = deployGitOnlyEnabled(env);
	let files = [];
	walkFiles(ROOT, ROOT, files);

	if (gitOnly) {
		const gitPaths = new Set(getGitDeployRelativePaths(env));
		const before = files.length;
		files = files.filter((file) => gitPaths.has(file.relative));
		console.log(`Git-only deploy: ${files.length} file(s) (${before} in theme)`);
	} else {
		console.log(`Full deploy: ${files.length} theme file(s)`);
	}

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

	let client = await connectDeployClient(env);
	let uploaded = 0;
	let skipped = 0;
	let reconnects = 0;

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

	try {
		await ensureRemoteDir(client, remotePath);

		for (const file of files) {
			try {
				await uploadOne(client, file);
			} catch (err) {
				const msg = String(err.message || '');
				if (!/fin packet|closed|timeout|econnreset/i.test(msg) || reconnects >= 5) {
					throw err;
				}
				reconnects += 1;
				console.log(`Reconnecting (${reconnects}/5)...`);
				try { client.close(); } catch (_) {}
				client = await connectDeployClient(env);
				await uploadOne(client, file);
			}
		}
	} finally {
		client.close();
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}`);
	console.log(`Remote theme: ${remotePath}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
