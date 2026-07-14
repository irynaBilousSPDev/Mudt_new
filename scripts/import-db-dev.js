/**
 * One-time: prepare production DB dump for dev (URL replace) and optional import.
 * Usage: npm run import:db:dev
 *
 * NOT part of /deploy-dev — run manually once when cloning prod to dev.
 */
const fs = require('fs');
const path = require('path');
const { spawnSync } = require('child_process');
const readline = require('readline');

const ROOT = path.resolve(__dirname, '..');
const ENV_FILE = path.join(ROOT, 'deploy.local.env');
const DEFAULT_BACKUP_ROOT = path.resolve(ROOT, '../../../../..');
const DEFAULT_SQL = path.join(DEFAULT_BACKUP_ROOT, 'sqldump.sql');
const OUTPUT_SQL = path.join(ROOT, 'scripts', 'sqldump-dev-ready.sql');

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

function replaceUrls(sql, fromUrl, toUrl) {
	const fromHttp = fromUrl.replace(/^https:/, 'http:');
	const toHttp = toUrl.replace(/^https:/, 'http:');
	let out = sql;
	const pairs = [
		[fromUrl, toUrl],
		[fromHttp, toHttp],
		[fromUrl.replace(/\/$/, ''), toUrl.replace(/\/$/, '')],
		[fromHttp.replace(/\/$/, ''), toHttp.replace(/\/$/, '')],
	];
	for (const [from, to] of pairs) {
		out = out.split(from).join(to);
	}
	return out;
}

function ask(question) {
	const rl = readline.createInterface({ input: process.stdin, output: process.stdout });
	return new Promise((resolve) => {
		rl.question(question, (answer) => {
			rl.close();
			resolve(answer.trim());
		});
	});
}

function tryMysqlImport(env, sqlPath) {
	const host = env.DB_HOST;
	const name = env.DB_NAME;
	const user = env.DB_USER;
	const password = env.DB_PASSWORD;
	if (!host || !name || !user || !password) {
		return false;
	}

	const mysql = spawnSync(
		'mysql',
		['-h', host, '-u', user, `-p${password}`, name],
		{ input: fs.readFileSync(sqlPath), stdio: ['pipe', 'inherit', 'inherit'] }
	);

	if (mysql.error) {
		console.log(`mysql CLI not available (${mysql.error.message}).`);
		return false;
	}
	return mysql.status === 0;
}

async function main() {
	const env = loadEnv(ENV_FILE);
	const sourceSql = env.BACKUP_SQL || DEFAULT_SQL;
	const prodUrl = env.PROD_SITE_URL || 'https://uni-munich.de';
	const devUrl = env.DEV_SITE_URL || 'https://iratest.site';

	if (!fs.existsSync(sourceSql)) {
		throw new Error(`SQL dump not found: ${sourceSql}\nSet BACKUP_SQL in deploy.local.env`);
	}

	console.log(`Reading: ${sourceSql}`);
	console.log(`URL replace: ${prodUrl} → ${devUrl}`);

	const raw = fs.readFileSync(sourceSql, 'utf8');
	const prepared = replaceUrls(raw, prodUrl, devUrl);
	fs.writeFileSync(OUTPUT_SQL, prepared);
	console.log(`Prepared SQL: ${OUTPUT_SQL}`);

	if (env.DB_HOST && env.DB_NAME && env.DB_USER && env.DB_PASSWORD) {
		const answer = process.env.FORCE_DB_IMPORT === 'true'
			? 'y'
			: await ask('Import into MySQL now? This REPLACES data in the target DB. [y/N] ');
		if (answer.toLowerCase() === 'y') {
			const ok = tryMysqlImport(env, OUTPUT_SQL);
			if (ok) {
				console.log('Database import finished.');
				return;
			}
		}
	}

	console.log('\nManual import (phpMyAdmin on Hostinger):');
	console.log('1. Open phpMyAdmin for your dev database');
	console.log('2. Drop existing tables OR use a fresh empty database');
	console.log(`3. Import file: ${OUTPUT_SQL}`);
	console.log('4. In wp-config.php set table prefix: nIF3Zpc_');
	console.log(`5. Confirm siteurl/home = ${devUrl}`);
	console.log('\nAfter import, also run once: npm run import:uploads:dev');
}

main().catch((err) => {
	console.error(err.message || err);
	process.exit(1);
});
