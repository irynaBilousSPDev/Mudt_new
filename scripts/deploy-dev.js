/**
 * Deploy Mudt_new theme via SFTP (reads deploy.local.env).
 * Usage: npm run deploy:dev
 */
const crypto = require('crypto');
const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');
const SftpClient = require('ssh2-sftp-client');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');

const EXCLUDE_DIR_NAMES = new Set([
	'node_modules',
	'.git',
	'.cursor',
	'scripts',
]);

const EXCLUDE_FILE_NAMES = new Set([
	'deploy.local.env',
	'deploy.local.env.example',
	'.DS_Store',
	'Thumbs.db',
]);

const EXCLUDE_FILE_BASENAMES = new Set([
	'package.json',
	'package-lock.json',
]);

function loadEnv(filePath) {
	if (!fs.existsSync(filePath)) {
		throw new Error(
			`Missing ${path.basename(filePath)}. Copy deploy.local.env.example and fill in SFTP_* values.`
		);
	}
	const env = {};
	for (const line of fs.readFileSync(filePath, 'utf8').split(/\r?\n/)) {
		const trimmed = line.trim();
		if (!trimmed || trimmed.startsWith('#')) {
			continue;
		}
		const eq = trimmed.indexOf('=');
		if (eq === -1) {
			continue;
		}
		const key = trimmed.slice(0, eq).trim();
		let value = trimmed.slice(eq + 1).trim();
		if (
			(value.startsWith('"') && value.endsWith('"')) ||
			(value.startsWith("'") && value.endsWith("'"))
		) {
			value = value.slice(1, -1);
		}
		env[key] = value;
	}
	['DEPLOY_GIT_REF', 'DEPLOY_FULL', 'DEPLOY_GIT_ONLY', 'DEPLOY_ALLOW_DIRTY', 'DEPLOY_ALLOW_UNPUSHED', 'DRY_RUN'].forEach(
		(key) => {
			if (process.env[key] !== undefined) {
				env[key] = process.env[key];
			}
		}
	);
	return env;
}

function envFlag(env, key) {
	return String(env[key] || '').toLowerCase() === 'true';
}

function deployGitOnlyEnabled(env) {
	if (envFlag(env, 'DEPLOY_FULL')) {
		return false;
	}
	if (env.DEPLOY_GIT_ONLY !== undefined) {
		return envFlag(env, 'DEPLOY_GIT_ONLY');
	}
	return true;
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
	const baseRef = env.DEPLOY_GIT_REF ? env.DEPLOY_GIT_REF.trim() : 'origin/dev';

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
		if (EXCLUDE_DIR_NAMES.has(part)) {
			return true;
		}
	}
	const base = parts[parts.length - 1];
	if (EXCLUDE_FILE_NAMES.has(base) || EXCLUDE_FILE_BASENAMES.has(base)) {
		return true;
	}
	if (base.endsWith('.php4')) {
		return true;
	}
	return false;
}

function walkFiles(dir, baseDir, list) {
	for (const name of fs.readdirSync(dir)) {
		const full = path.join(dir, name);
		const rel = path.relative(baseDir, full).split(path.sep).join('/');
		if (shouldSkip(rel)) {
			continue;
		}
		const stat = fs.statSync(full);
		if (stat.isDirectory()) {
			walkFiles(full, baseDir, list);
		} else {
			list.push({ local: full, relative: rel, mtime: stat.mtimeMs, size: stat.size });
		}
	}
}

function buildSftpConfig(env) {
	const host = env.SFTP_HOST;
	const port = parseInt(env.SFTP_PORT || '22', 10);
	const username = env.SFTP_USER;
	const remotePath = env.SFTP_REMOTE_PATH;
	const password = env.SFTP_PASSWORD;

	if (!host || !username || !remotePath) {
		throw new Error('SFTP_HOST, SFTP_USER, and SFTP_REMOTE_PATH are required in deploy.local.env');
	}
	if (!password) {
		throw new Error('Set SFTP_PASSWORD in deploy.local.env');
	}

	return {
		config: { host, port, username, password, readyTimeout: 30000 },
		remotePath: remotePath.replace(/\\/g, '/').replace(/\/+$/, ''),
	};
}

async function ensureRemoteDir(sftp, remoteDir) {
	const normalized = remoteDir.replace(/\\/g, '/').replace(/\/+$/, '');
	if (!normalized) {
		return;
	}
	try {
		await sftp.mkdir(normalized, true);
	} catch (err) {
		if (err.code !== 4) {
			throw err;
		}
	}
}

function localFileHash(filePath) {
	return crypto.createHash('md5').update(fs.readFileSync(filePath)).digest('hex');
}

async function remoteNeedsUpload(sftp, remoteFile, localMeta) {
	try {
		const stat = await sftp.stat(remoteFile);
		if (stat.size !== localMeta.size) {
			return true;
		}
		const remoteData = await sftp.get(remoteFile);
		let remoteBuffer;
		if (Buffer.isBuffer(remoteData)) {
			remoteBuffer = remoteData;
		} else if (Array.isArray(remoteData)) {
			remoteBuffer = Buffer.concat(remoteData);
		} else {
			remoteBuffer = Buffer.from(remoteData);
		}
		return localFileHash(localMeta.local) !== crypto.createHash('md5').update(remoteBuffer).digest('hex');
	} catch (err) {
		const msg = String(err.message || '');
		if (err.code === 2 || /no such file/i.test(msg)) {
			return true;
		}
		throw err;
	}
}

function listDirtyTrackedFiles() {
	const out = execSync('git status --porcelain', { cwd: ROOT, encoding: 'utf8' });
	const files = [];
	for (const line of out.split(/\r?\n/)) {
		if (!line.trim()) {
			continue;
		}
		files.push(line.slice(3).trim().replace(/\\/g, '/'));
	}
	return files;
}

function assertGitReadyForDeploy(env) {
	if (envFlag(env, 'DEPLOY_ALLOW_DIRTY')) {
		return;
	}
	const dirty = listDirtyTrackedFiles();
	if (dirty.length) {
		throw new Error(
			`Deploy blocked: uncommitted changes (${dirty.join(', ')}). Commit first.`
		);
	}
	if (envFlag(env, 'DEPLOY_ALLOW_UNPUSHED')) {
		return;
	}
	if (!gitRefExists('origin/dev')) {
		return;
	}
	const ahead = execSync('git rev-list --count origin/dev..HEAD', {
		cwd: ROOT,
		encoding: 'utf8',
	}).trim();
	if (parseInt(ahead, 10) > 0) {
		throw new Error(
			`Deploy blocked: push first (git push origin dev) — ${ahead} commit(s) not on GitHub yet.`
		);
	}
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const dryRun = envFlag(env, 'DRY_RUN');
	const { config, remotePath } = buildSftpConfig(env);

	console.log(`Deploy target: dev → ${config.host}`);
	assertGitReadyForDeploy(env);
	console.log('Git check OK.');

	const gitOnly = deployGitOnlyEnabled(env);
	let files = [];
	walkFiles(ROOT, ROOT, files);

	if (gitOnly) {
		const gitPaths = new Set(getGitDeployRelativePaths(env));
		const before = files.length;
		files = files.filter((file) => gitPaths.has(file.relative));
		console.log(
			`Git-only deploy: ${files.length} file(s) (${before} in theme; DEPLOY_FULL=true for full sync)`
		);
	} else {
		console.log(`Full deploy: ${files.length} theme file(s)`);
	}

	if (!files.length) {
		console.log('Nothing to upload.');
		return;
	}

	if (dryRun) {
		console.log('DRY_RUN=true — no upload.');
		for (const file of files) {
			console.log(`[dry-run] ${file.relative}`);
		}
		return;
	}

	const sftp = new SftpClient();
	let uploaded = 0;
	let skipped = 0;

	try {
		console.log(`Connecting to ${config.host}:${config.port} as ${config.username}...`);
		await sftp.connect(config);
		await ensureRemoteDir(sftp, remotePath);

		for (const file of files) {
			const remoteFile = `${remotePath}/${file.relative}`.replace(/\/+/g, '/');
			const remoteDir = path.posix.dirname(remoteFile);
			await ensureRemoteDir(sftp, remoteDir);

			if (await remoteNeedsUpload(sftp, remoteFile, file)) {
				process.stdout.write(`↑ ${file.relative}\n`);
				await sftp.fastPut(file.local, remoteFile);
				uploaded += 1;
			} else {
				skipped += 1;
			}
		}
	} finally {
		await sftp.end();
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}`);
	console.log(`Remote theme: ${remotePath}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
