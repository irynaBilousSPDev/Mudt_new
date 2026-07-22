# MUDT WordPress Theme (Mudt_new)

Custom theme for Munich University of Digital Technologies.

## Infrastructure

| Site | URL | Hosting |
|------|-----|---------|
| Production | uni-munich.de | Plesk (backup source) |
| **Dev** | [iratest.site](https://iratest.site/) | **Hostinger** (SFTP port `65002`) |

Dev deploy uses **Hostinger SFTP**, not Plesk. The local backup folder is from Plesk prod — only the **source** for one-time DB/media import.

## Requirements

- WordPress 6+
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- Contact Form 7

## Cursor commands

| Command | Purpose |
|---------|---------|
| `/deploy-dev` | Commit → push `dev` → FTP theme to dev |
| `/deploy-prod` | Merge `dev` → `main` → push → FTPS theme to prod |
| `/import-db-dev` | **One-time** prod DB clone to dev |

## Local setup

```bash
cp deploy.local.env.example deploy.local.env
# Edit deploy.local.env with SFTP password (never commit)
npm install
```

## Deploy theme to dev

```bash
git checkout dev
npm run deploy:dev
```

## Deploy theme to prod

```bash
git checkout main
npm run deploy:prod
```

Use `/deploy-prod` in Cursor for the full merge → push → deploy flow.

First deploy: `DEPLOY_FULL=true npm run deploy:prod`

## One-time dev clone from prod backup

```bash
npm run import:db:dev
npm run import:uploads:dev
```

## GitHub

https://github.com/irynaBilousSPDev/Mudt_new.git

Branch: `dev` (day-to-day work), `main` (production deploy via `/deploy-prod`)
