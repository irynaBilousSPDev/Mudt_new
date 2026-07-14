/**
 * One-time: upload wp-content/uploads from Plesk backup to dev via SFTP.
 * Usage: npm run import:uploads:dev
 */
const fs = require('fs');
const path = require('path');
const SftpClient = require('ssh2-sftp-client');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');
const DEFAULT_UPLOADS = path.resolve(ROOT, '../../../uploads');

function loadEnv(filePath) {
	if (!fs.existsSync(filePath)) {
		throw new Error(`Missing ${path.basename(filePath)}`);
	}
	const env = {};
	for (const line of fs.readFileSync(filePath, 'utf8').split(/\r?\n/)) {
		const trimmed = line.trim();
		if (!trimmed || trimmed.startsWith('#')) continue;
		const eq = trimmed.indexOf('=');
		if (eq === -1) continue;
		const key = trimmed.slice(0, eq).trim();
		let value = trimmed.slice(eq + 1).trim();
		if ((value.startsWith('"') && value.endsWith('"')) || (value.startsWith("'") && value.endsWith("'"))) {
			value = value.slice(1, -1);
		}
		env[key] = value;
	}
	return env;
}

function walkFiles(dir, baseDir, list) {
	for (const name of fs.readdirSync(dir)) {
		const full = path.join(dir, name);
		const rel = path.relative(baseDir, full).split(path.sep).join('/');
		const stat = fs.statSync(full);
		if (stat.isDirectory()) {
			walkFiles(full, baseDir, list);
		} else {
			list.push({ local: full, relative: rel, size: stat.size });
		}
	}
}

async function ensureRemoteDir(sftp, remoteDir) {
	try {
		await sftp.mkdir(remoteDir.replace(/\\/g, '/').replace(/\/+$/, ''), true);
	} catch (err) {
		if (err.code !== 4) throw err;
	}
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const uploadsLocal = env.BACKUP_UPLOADS || DEFAULT_UPLOADS;
	const themeRemote = env.SFTP_REMOTE_PATH;
	const uploadsRemote = env.SFTP_UPLOADS_REMOTE_PATH
		|| themeRemote.replace(/\/themes\/[^/]+$/, '/uploads');

	if (!fs.existsSync(uploadsLocal)) {
		throw new Error(`Uploads folder not found: ${uploadsLocal}`);
	}

	const files = [];
	walkFiles(uploadsLocal, uploadsLocal, files);
	console.log(`Uploading ${files.length} media file(s) to ${uploadsRemote}`);

	const sftp = new SftpClient();
	let uploaded = 0;
	try {
		await sftp.connect({
			host: env.SFTP_HOST,
			port: parseInt(env.SFTP_PORT || '22', 10),
			username: env.SFTP_USER,
			password: env.SFTP_PASSWORD,
			readyTimeout: 30000,
		});
		await ensureRemoteDir(sftp, uploadsRemote);

		for (const file of files) {
			const remoteFile = `${uploadsRemote}/${file.relative}`.replace(/\/+/g, '/');
			await ensureRemoteDir(sftp, path.posix.dirname(remoteFile));
			try {
				const stat = await sftp.stat(remoteFile);
				if (stat.size === file.size) {
					continue;
				}
			} catch (err) {
				// upload
			}
			process.stdout.write(`↑ ${file.relative}\n`);
			await sftp.fastPut(file.local, remoteFile);
			uploaded += 1;
		}
	} finally {
		await sftp.end();
	}

	console.log(`Done. Uploaded: ${uploaded} new/changed files.`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
