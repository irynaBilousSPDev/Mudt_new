/**
 * Probe FTP paths on Hostinger dev server.
 * Usage: node scripts/probe-sftp.js
 */
const { loadEnv, connectFtp } = require('./ftp-client');

async function listDir(client, dir) {
	console.log(`\n=== ${dir} ===`);
	try {
		const items = await client.list(dir);
		for (const item of items.slice(0, 25)) {
			console.log(`  ${item.type} ${item.name}`);
		}
		if (items.length > 25) {
			console.log(`  ... ${items.length - 25} more`);
		}
	} catch (err) {
		console.log(`  (cannot list: ${err.message})`);
	}
}

async function main() {
	const env = loadEnv();
	const client = await connectFtp(env);
	console.log(`Connected: ${env.SFTP_USER}@${env.SFTP_HOST}:${env.SFTP_PORT || 21}`);

	for (const dir of ['.', 'wp-content', 'wp-content/themes', env.SFTP_REMOTE_PATH].filter(Boolean)) {
		await listDir(client, dir);
	}

	client.close();
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
