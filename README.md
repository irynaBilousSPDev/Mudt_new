# MUDT WordPress Theme (Mudt_new)

Custom theme for Munich University of Digital Technologies — deployed to dev at [iratest.site](https://iratest.site/).

## Requirements

- WordPress 6+
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- Contact Form 7

## Cursor commands

| Command | Purpose |
|---------|---------|
| `/deploy-dev` | Commit → push `dev` → SFTP theme to dev |
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

First deploy: `DEPLOY_FULL=true npm run deploy:dev`

## One-time dev clone from prod backup

```bash
npm run import:db:dev
npm run import:uploads:dev
```

## GitHub

https://github.com/irynaBilousSPDev/Mudt_new.git

Branch: `dev` (day-to-day work)
