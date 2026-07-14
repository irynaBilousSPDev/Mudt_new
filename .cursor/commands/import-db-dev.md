**One-time** — clone production database to dev [iratest.site](https://iratest.site/) on **Hostinger**.

Use this **once** when setting up dev with a prod copy. **Not** part of `/deploy-dev`.

## Servers

| Environment | Hosting | Notes |
|-------------|---------|-------|
| **Production** (`uni-munich.de`) | Plesk | Source of local backup (`sqldump.sql`, uploads) |
| **Dev** (`iratest.site`) | **Hostinger** | Target — import DB via hPanel phpMyAdmin, deploy theme via SFTP |

## What it does

1. Reads **Plesk prod backup** `sqldump.sql` (path in `deploy.local.env` → `BACKUP_SQL`)
2. Replaces URLs: `https://uni-munich.de` → `https://iratest.site`
3. Writes `scripts/sqldump-dev-ready.sql`
4. Optionally imports via `mysql` CLI if `DB_*` credentials are set
5. Otherwise prints **phpMyAdmin** import steps

## Run

```bash
npm run import:db:dev
```

## After DB import

1. **Uploads (one-time):** `npm run import:uploads:dev`
2. **Theme (full):** `DEPLOY_FULL=true npm run deploy:dev` or `/deploy-dev`
3. **WP admin on dev:**
   - Activate **Mudt_new** theme
   - Install plugins: **ACF Pro**, **Contact Form 7** (from backup if needed)
   - Settings → Permalinks → Save
   - Assign menus: Primary, News, Footer
4. **wp-config.php** on dev must use table prefix: `nIF3Zpc_`

## phpMyAdmin (Hostinger hPanel)

1. [Hostinger hPanel](https://hpanel.hostinger.com/) → **Websites** → **iratest.site** → **Databases** → **phpMyAdmin**
2. Select the WordPress database for iratest.site (or create a new empty one)
3. If replacing the old uniXedu site: **drop all tables** in that database first
4. **Import** → choose `scripts/sqldump-dev-ready.sql` (~52 MB — may take a few minutes)
5. In File Manager edit `public_html/wp-config.php`:
   - `$table_prefix = 'nIF3Zpc_';`
   - DB name, user, password must match Hostinger database credentials

## Security on dev

- Disable or change GTM/GA IDs in theme if needed
- Disable Symanto chat widget in `footer.php` for dev (optional)
- Use dev-only admin email in WP settings

## Do not

- Run this on every deploy
- Commit `deploy.local.env` or `sqldump-dev-ready.sql`
