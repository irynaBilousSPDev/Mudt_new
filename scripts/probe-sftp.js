/**
 * Probe SFTP paths on dev server.
 * Usage: node scripts/probe-sftp.js
 */
const fs = require('fs');
const path = require('path');
const SftpClient = require('ssh2-sftp-client');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');

function loadEnv(filePath) {
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

async function listDir(sftp, dir, depth = 0) {
	const pad = '  '.repeat(depth);
	try {
		const items = await sftp.list(dir);
		for (const item of items.slice(0, 30)) {
			console.log(`${pad}${item.type} ${item.name}`);
			if (item.type === 'd' && depth < 2 && ['domains', 'public_html', 'wp-content', 'themes'].includes(item.name)) {
				await listDir(sftp, `${dir}/${item.name}`.replace(/\/+/g, '/'), depth + 1);
			}
		}
		if (items.length > 30) {
			console.log(`${pad}... ${items.length - 30} more`);
		}
	} catch (err) {
		console.log(`${pad}(cannot list ${dir}: ${err.message})`);
	}
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const sftp = new SftpClient();
	await sftp.connect({
		host: env.SFTP_HOST,
		port: parseInt(env.SFTP_PORT || '22', 10),
		username: env.SFTP_USER,
		password: env.SFTP_PASSWORD,
		readyTimeout: 30000,
	});

	const candidates = [
		'.',
		'domains',
		'domains/iratest.site',
		'domains/iratest.site/public_html',
		'public_html',
		env.SFTP_REMOTE_PATH,
	].filter(Boolean);

	for (const dir of [...new Set(candidates)]) {
		console.log(`\n=== ${dir} ===`);
		await listDir(sftp, dir);
	}

	await sftp.end();
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
