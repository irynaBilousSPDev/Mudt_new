/**
 * Read-only FTP/SFTP probe — list remote paths, no uploads.
 * Usage: node scripts/probe-sftp.js [dev|prod]
 */
const { loadEnv, cfg, connectFtp, connectFtpForTarget, connectSftp, normalizeRemotePath } = require('./ftp-client');

const TARGET = (process.argv[2] || 'dev').toLowerCase();

if (TARGET !== 'dev' && TARGET !== 'prod') {
	console.error('Usage: node scripts/probe-sftp.js [dev|prod]');
	process.exit(1);
}

async function listFtpDir(client, dir) {
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

async function listSftpDir(client, dir) {
	console.log(`\n=== ${dir} ===`);
	try {
		const items = await client.list(dir);
		for (const item of items.slice(0, 25)) {
			const type = item.type === 'd' ? 'd' : '-';
			console.log(`  ${type} ${item.name}`);
		}
		if (items.length > 25) {
			console.log(`  ... ${items.length - 25} more`);
		}
	} catch (err) {
		console.log(`  (cannot list: ${err.message})`);
	}
}

async function probeDev(env) {
	const client = await connectFtp(env);
	console.log(`Connected (FTP): ${env.SFTP_USER}@${env.SFTP_HOST}:${env.SFTP_PORT || 21}`);

	for (const dir of ['.', 'wp-content', 'wp-content/themes', env.SFTP_REMOTE_PATH].filter(Boolean)) {
		await listFtpDir(client, dir);
	}

	client.close();
}

async function probeProd(env) {
	const host = cfg(env, 'prod', 'HOST');
	const port = cfg(env, 'prod', 'PORT') || '21';
	const user = cfg(env, 'prod', 'USER');
	const remotePath = normalizeRemotePath(cfg(env, 'prod', 'REMOTE_PATH') || 'httpdocs/wp-content/themes/Mudt_new');
	const useSftp = String(env.SFTP_PROD_USE_SFTP || '').toLowerCase() === 'true' || port === '22';

	if (!host || !user || !cfg(env, 'prod', 'PASSWORD')) {
		throw new Error('Set SFTP_PROD_HOST, SFTP_PROD_USER, and SFTP_PROD_PASSWORD in deploy.local.env');
	}

	if (useSftp) {
		const client = await connectSftp(env, 'prod');
		console.log(`Connected (SFTP): ${user}@${host}:${port}`);
		for (const dir of ['.', 'httpdocs', 'httpdocs/wp-content', 'httpdocs/wp-content/themes', remotePath]) {
			await listSftpDir(client, dir);
		}
		await client.end();
		return;
	}

	const client = await connectFtpForTarget(env, 'prod');
	const secure = String(env.SFTP_PROD_USE_FTPS || '').toLowerCase() === 'true' ? 'FTPS' : 'FTP';
	console.log(`Connected (${secure}): ${user}@${host}:${port}`);
	console.log(`FTP root: ${client._deployRoot}`);

	for (const dir of ['.', 'httpdocs', 'httpdocs/wp-content', 'httpdocs/wp-content/themes', remotePath]) {
		await listFtpDir(client, dir);
	}

	client.close();
}

async function main() {
	const env = loadEnv();
	console.log(`Probe target: ${TARGET} (read-only)`);

	if (TARGET === 'prod') {
		await probeProd(env);
		return;
	}

	await probeDev(env);
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
