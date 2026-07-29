/**
 * Upload only media files referenced in a prepared SQL dump (local helper).
 *
 * Usage: node scripts/import-uploads-used-dev.js
 */
const fs = require('fs');
const path = require('path');
const {
	ROOT,
	loadEnv,
	normalizeRemotePath,
	connectFtp,
	resetCwd,
	ensureRemoteDir,
	remoteFileSize,
} = require('./ftp-client');

const ENV_FILE = path.join(ROOT, 'deploy.local.env');
const DEFAULT_SQL = path.join(ROOT, 'scripts', 'sqldump-dev-ready.sql');
const DEFAULT_UPLOADS = path.resolve(ROOT, '../../../files/wp-content/uploads');

function collectUsedUploadRels(sqlText) {
	const found = new Set();
	// Matches paths like 2024/05/foo.webp or uploads/2024/05/foo.webp
	const re =
		/(?:uploads\/|wp-content\/uploads\/|(?:[a-z0-9.-]+)\/wp-content\/uploads\/)(\d{4}\/\d{2}\/[A-Za-z0-9._\-]+)/gi;
	let m;
	while ((m = re.exec(sqlText)) !== null) {
		found.add(m[1].replace(/\\+/g, ''));
	}
	// Also catch JSON-escaped slashes: 2024\/05\/file.webp
	const reEsc =
		/(?:uploads\\\/|wp-content\\\/uploads\\\/)(\d{4}\\\/\d{2}\\\/[A-Za-z0-9._\-]+)/gi;
	while ((m = reEsc.exec(sqlText)) !== null) {
		found.add(m[1].replace(/\\\//g, '/'));
	}
	return [...found];
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const sqlPath = env.BACKUP_SQL_PREPARED || DEFAULT_SQL;
	const uploadsLocal = env.BACKUP_UPLOADS || DEFAULT_UPLOADS;
	const themeRemote = normalizeRemotePath(env.SFTP_REMOTE_PATH || 'wp-content/themes/Mudt_new');
	const uploadsRemote = normalizeRemotePath(
		env.SFTP_UPLOADS_REMOTE_PATH || themeRemote.replace(/\/themes\/[^/]+$/, '/uploads')
	);

	if (!fs.existsSync(sqlPath)) {
		throw new Error(`Prepared SQL not found: ${sqlPath}`);
	}
	if (!fs.existsSync(uploadsLocal)) {
		throw new Error(`Uploads folder not found: ${uploadsLocal}`);
	}

	console.log(`Scanning references in: ${sqlPath}`);
	const sql = fs.readFileSync(sqlPath, 'utf8');
	const refs = collectUsedUploadRels(sql);
	console.log(`Unique upload refs in DB: ${refs.length}`);

	const files = [];
	let missing = 0;
	for (const rel of refs) {
		const local = path.join(uploadsLocal, rel);
		if (!fs.existsSync(local) || !fs.statSync(local).isFile()) {
			missing += 1;
			continue;
		}
		files.push({ local, relative: rel, size: fs.statSync(local).size });
	}
	console.log(`Present on disk: ${files.length}, missing locally: ${missing}`);
	console.log(`Target: ${uploadsRemote}`);

	const client = await connectFtp(env);
	let uploaded = 0;
	let skipped = 0;
	let reconnects = 0;

	async function uploadOne(active, file) {
		const remoteFile = `${uploadsRemote}/${file.relative}`.replace(/\/+/g, '/');
		await ensureRemoteDir(active, path.posix.dirname(remoteFile));
		const remoteSize = await remoteFileSize(active, remoteFile);
		if (remoteSize === file.size) {
			skipped += 1;
			return active;
		}
		process.stdout.write(`↑ ${file.relative}\n`);
		await resetCwd(active);
		await active.uploadFrom(file.local, remoteFile);
		uploaded += 1;
		return active;
	}

	try {
		await ensureRemoteDir(client, uploadsRemote);
		let active = client;
		for (const file of files) {
			try {
				active = await uploadOne(active, file);
			} catch (err) {
				const msg = String(err.message || err);
				if (!/timeout|fin packet|closed|econnreset|session timeout/i.test(msg) || reconnects >= 8) {
					throw err;
				}
				reconnects += 1;
				console.log(`Reconnecting (${reconnects}/8)...`);
				try {
					active.close();
				} catch (_) {}
				active = await connectFtp(env);
				await uploadOne(active, file);
			}
		}
		try {
			active.close();
		} catch (_) {}
	} catch (err) {
		try {
			client.close();
		} catch (_) {}
		throw err;
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}, reconnects: ${reconnects}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
