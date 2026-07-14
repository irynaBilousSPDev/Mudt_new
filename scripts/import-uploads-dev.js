/**
 * One-time: upload wp-content/uploads from Plesk prod backup to Hostinger dev via FTP.
 */
const fs = require('fs');
const path = require('path');
const {
	loadEnv,
	normalizeRemotePath,
	connectFtp,
	resetCwd,
	ensureRemoteDir,
	remoteFileSize,
} = require('./ftp-client');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');
const DEFAULT_UPLOADS = path.resolve(ROOT, '../../../uploads');

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

async function main() {
	const env = loadEnv(ENV_FILE);
	const uploadsLocal = env.BACKUP_UPLOADS || DEFAULT_UPLOADS;
	const themeRemote = normalizeRemotePath(env.SFTP_REMOTE_PATH || 'wp-content/themes/Mudt_new');
	const uploadsRemote = normalizeRemotePath(
		env.SFTP_UPLOADS_REMOTE_PATH || themeRemote.replace(/\/themes\/[^/]+$/, '/uploads')
	);

	if (!fs.existsSync(uploadsLocal)) {
		throw new Error(`Uploads folder not found: ${uploadsLocal}`);
	}

	const files = [];
	walkFiles(uploadsLocal, uploadsLocal, files);
	console.log(`Uploading ${files.length} media file(s) to ${uploadsRemote}`);

	const client = await connectFtp(env);
	let uploaded = 0;
	let skipped = 0;

	try {
		await ensureRemoteDir(client, uploadsRemote);

		for (const file of files) {
			const remoteFile = `${uploadsRemote}/${file.relative}`.replace(/\/+/g, '/');
			await ensureRemoteDir(client, path.posix.dirname(remoteFile));

			const remoteSize = await remoteFileSize(client, remoteFile);
			if (remoteSize === file.size) {
				skipped += 1;
				continue;
			}

			process.stdout.write(`↑ ${file.relative}\n`);
			await resetCwd(client);
			await client.uploadFrom(file.local, remoteFile);
			uploaded += 1;
		}
	} finally {
		client.close();
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
