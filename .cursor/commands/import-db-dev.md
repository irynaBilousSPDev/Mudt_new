**One-time** — clone production database to dev [iratest.site](https://iratest.site/).

Use this **once** when setting up dev with a prod copy. **Not** part of `/deploy-dev`.

## What it does

1. Reads Plesk backup `sqldump.sql` (path in `deploy.local.env` → `BACKUP_SQL`)
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

## phpMyAdmin (Hostinger)

1. hPanel → Databases → phpMyAdmin
2. Select dev database (or create empty one)
3. **Import** → choose `scripts/sqldump-dev-ready.sql`
4. If replacing old site: drop all tables first, or use a fresh DB

## Security on dev

- Disable or change GTM/GA IDs in theme if needed
- Disable Symanto chat widget in `footer.php` for dev (optional)
- Use dev-only admin email in WP settings

## Do not

- Run this on every deploy
- Commit `deploy.local.env` or `sqldump-dev-ready.sql`
