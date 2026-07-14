/**
 * One-time: upload a plugin folder from Plesk prod backup to Hostinger dev via FTP.
 * Usage: node scripts/import-plugin-dev.js advanced-custom-fields-pro
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
const DEFAULT_PLUGINS_ROOT = path.resolve(ROOT, '../../plugins');

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

async function uploadOne(env, client, pluginRemote, file) {
	const remoteFile = `${pluginRemote}/${file.relative}`.replace(/\/+/g, '/');
	await ensureRemoteDir(client, path.posix.dirname(remoteFile));

	const remoteSize = await remoteFileSize(client, remoteFile);
	if (remoteSize === file.size) {
		return 'skipped';
	}

	process.stdout.write(`↑ ${file.relative}\n`);
	await resetCwd(client);
	await client.uploadFrom(file.local, remoteFile);
	return 'uploaded';
}

async function main() {
	const pluginSlug = process.argv[2];
	if (!pluginSlug) {
		throw new Error('Usage: node scripts/import-plugin-dev.js <plugin-folder-name>');
	}

	const env = loadEnv(ENV_FILE);
	const pluginsRoot = env.BACKUP_PLUGINS || DEFAULT_PLUGINS_ROOT;
	const pluginLocal = path.join(pluginsRoot, pluginSlug);
	const pluginsRemote = normalizeRemotePath(
		env.SFTP_PLUGINS_REMOTE_PATH || 'wp-content/plugins'
	);
	const pluginRemote = `${pluginsRemote}/${pluginSlug}`;

	if (!fs.existsSync(pluginLocal)) {
		throw new Error(`Plugin not found in backup: ${pluginLocal}`);
	}

	const files = [];
	walkFiles(pluginLocal, pluginLocal, files);
	console.log(`Uploading ${files.length} file(s) for ${pluginSlug} → ${pluginRemote}`);

	let client = await connectFtp(env);
	let uploaded = 0;
	let skipped = 0;
	let reconnects = 0;

	try {
		await ensureRemoteDir(client, pluginRemote);

		for (const file of files) {
			try {
				const result = await uploadOne(env, client, pluginRemote, file);
				if (result === 'uploaded') uploaded += 1;
				else skipped += 1;
			} catch (err) {
				const msg = String(err.message || '');
				if (!/fin packet|closed|timeout|econnreset/i.test(msg) || reconnects >= 10) {
					throw err;
				}
				reconnects += 1;
				console.log(`Reconnecting (${reconnects}/10)...`);
				try { client.close(); } catch (_) {}
				client = await connectFtp(env);
				const result = await uploadOne(env, client, pluginRemote, file);
				if (result === 'uploaded') uploaded += 1;
				else skipped += 1;
			}
		}
	} finally {
		client.close();
	}

	console.log(`Done. Uploaded: ${uploaded}, unchanged: ${skipped}`);
	console.log(`Activate in WP Admin → Plugins → ${pluginSlug}`);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
