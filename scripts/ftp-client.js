/**
 * FTP/FTPS connection helper (credentials from deploy.local.env).
 */
const fs = require('fs');
const path = require('path');
const ftp = require('basic-ftp');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');

function loadEnv(filePath = ENV_FILE) {
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
		if (
			(value.startsWith('"') && value.endsWith('"')) ||
			(value.startsWith("'") && value.endsWith("'"))
		) {
			value = value.slice(1, -1);
		}
		env[key] = value;
	}
	[
		'DEPLOY_GIT_REF',
		'DEPLOY_FULL',
		'DEPLOY_GIT_ONLY',
		'DEPLOY_ALLOW_DIRTY',
		'DEPLOY_ALLOW_UNPUSHED',
		'DRY_RUN',
		'FTP_PASSIVE',
	].forEach((key) => {
		if (process.env[key] !== undefined) {
			env[key] = process.env[key];
		}
	});
	return env;
}

function envFlag(env, key) {
	return String(env[key] || '').toLowerCase() === 'true';
}

function normalizeRemotePath(remotePath) {
	return remotePath.replace(/\\/g, '/').replace(/^\/+/, '').replace(/\/+$/, '');
}

async function connectFtpForTarget(env, target = 'dev') {
	const host = cfg(env, target, 'HOST');
	const port = parseInt(cfg(env, target, 'PORT') || '21', 10);
	const user = cfg(env, target, 'USER');
	const password = cfg(env, target, 'PASSWORD');
	const prefix = target === 'prod' ? 'SFTP_PROD_' : 'SFTP_';

	if (!host || !user || !password) {
		throw new Error(`${prefix}HOST, ${prefix}USER, and ${prefix}PASSWORD are required in deploy.local.env`);
	}

	const useFtps = envFlag(env, target === 'prod' ? 'SFTP_PROD_USE_FTPS' : 'SFTP_USE_FTPS');
	const passiveOff =
		String(env[target === 'prod' ? 'SFTP_PROD_FTP_PASSIVE' : 'FTP_PASSIVE'] || '').toLowerCase() ===
		'false';

	const client = new ftp.Client(120000);
	client.ftp.verbose = false;
	if (passiveOff) {
		client.ftp.passive = false;
	}
	await client.access({
		host,
		port,
		user,
		password,
		secure: useFtps,
	});
	client._deployRoot = await client.pwd();
	return client;
}

async function connectFtp(env) {
	return connectFtpForTarget(env, 'dev');
}

async function resetCwd(client) {
	if (client._deployRoot) {
		await client.cd(client._deployRoot);
	}
}

async function ensureRemoteDir(client, remoteDir) {
	const normalized = normalizeRemotePath(remoteDir);
	if (!normalized || normalized === '.') {
		return;
	}

	await resetCwd(client);
	await client.ensureDir(normalized);
	await resetCwd(client);
}

async function remoteFileSize(client, remoteFile) {
	try {
		await resetCwd(client);
		const size = await client.size(remoteFile);
		return size;
	} catch (err) {
		return null;
	}
}

function cfg(env, target, key) {
	if (target === 'prod') {
		return env[`SFTP_PROD_${key}`];
	}
	return env[`SFTP_${key}`];
}

function targetLabel(target) {
	return target === 'prod' ? 'prod' : 'dev';
}

async function connectSftp(env, target = 'dev') {
	const SftpClient = require('ssh2-sftp-client');
	const host = cfg(env, target, 'HOST');
	const port = parseInt(cfg(env, target, 'PORT') || '22', 10);
	const username = cfg(env, target, 'USER');
	const password = cfg(env, target, 'PASSWORD');
	const prefix = target === 'prod' ? 'SFTP_PROD_' : 'SFTP_';

	if (!host || !username || !password) {
		throw new Error(`${prefix}HOST, ${prefix}USER, and ${prefix}PASSWORD are required in deploy.local.env`);
	}

	const client = new SftpClient();
	await client.connect({ host, port, username, password, readyTimeout: 30000 });
	return client;
}

async function connectTarget(env, target = 'dev') {
	const port = parseInt(cfg(env, target, 'PORT') || (target === 'prod' ? '21' : '21'), 10);
	const useSftp =
		envFlag(env, target === 'prod' ? 'SFTP_PROD_USE_SFTP' : 'SFTP_USE_SFTP') || port === 22;
	if (useSftp) {
		return { type: 'sftp', client: await connectSftp(env, target) };
	}
	return { type: 'ftp', client: await connectFtpForTarget(env, target) };
}

async function closeTarget(connection) {
	if (!connection) return;
	if (connection.type === 'sftp') {
		await connection.client.end();
		return;
	}
	connection.client.close();
}

module.exports = {
	ROOT,
	ENV_FILE,
	loadEnv,
	envFlag,
	cfg,
	targetLabel,
	normalizeRemotePath,
	connectFtp,
	connectFtpForTarget,
	connectSftp,
	connectTarget,
	closeTarget,
	resetCwd,
	ensureRemoteDir,
	remoteFileSize,
};
