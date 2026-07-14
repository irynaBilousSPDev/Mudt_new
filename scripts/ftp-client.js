/**
 * Hostinger FTP connection helper (plain FTP port 21).
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

async function connectFtp(env) {
	const host = env.SFTP_HOST;
	const port = parseInt(env.SFTP_PORT || '21', 10);
	const user = env.SFTP_USER;
	const password = env.SFTP_PASSWORD;

	if (!host || !user || !password) {
		throw new Error('SFTP_HOST, SFTP_USER, and SFTP_PASSWORD are required in deploy.local.env');
	}

	const client = new ftp.Client(120000);
	client.ftp.verbose = false;
	await client.access({
		host,
		port,
		user,
		password,
		secure: false,
	});
	// Remember FTP root (public_html) — ensureDir changes cwd on Hostinger.
	client._deployRoot = await client.pwd();
	return client;
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

module.exports = {
	ROOT,
	ENV_FILE,
	loadEnv,
	envFlag,
	normalizeRemotePath,
	connectFtp,
	resetCwd,
	ensureRemoteDir,
	remoteFileSize,
};
