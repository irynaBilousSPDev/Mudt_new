# MUDT WordPress Theme (Mudt_new)

Custom theme for **Munich University of Digital Technologies & Applied Sciences**.

| Doc | Purpose |
|-----|---------|
| [ARCHITECTURE.md](./ARCHITECTURE.md) | Folders, SCSS bundles, where to edit |
| [CONTRIBUTING.md](./CONTRIBUTING.md) | Branches, commits, deploy workflow |
| [CHANGELOG.md](./CHANGELOG.md) | Version history |
| [LICENSE](./LICENSE) | Proprietary — all rights reserved |
| [scss/README.txt](./scss/README.txt) | SCSS migration notes |

## Infrastructure

| Site | URL | Hosting |
|------|-----|---------|
| Production | uni-munich.de | Plesk / Contabo (FTPS) |
| **Dev** | [iratest.site](https://iratest.site/) | Hostinger (FTP port `21` for theme sub-account; SFTP `65002` for main) |

Remote theme folder name: **`Mudt_new`**.

## Requirements

- WordPress 6+
- PHP 8.0+ recommended
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- Contact Form 7
- Node.js 18+ (local build / deploy scripts only)

## Local setup

```bash
cp deploy.local.env.example deploy.local.env
# Edit deploy.local.env with FTP/SFTP passwords — never commit this file

npm install
npm run watch    # rebuild CSS/JS on change
# or
npm run build    # one-shot CSS + JS
```

### NPM scripts

| Script | Action |
|--------|--------|
| `npm run build` | Compile all SCSS bundles + minify `main.js` |
| `npm run build:css` | SCSS → `css/*.css` |
| `npm run build:js` | `js/main.js` → `js/main.min.js` |
| `npm run watch` | Watch SCSS + JS |
| `npm run deploy:dev` | Upload theme to DEV |
| `npm run deploy:prod` | Upload theme to PROD |
| `npm run import:db:dev` | One-time DB clone to DEV |
| `npm run import:uploads:dev` | One-time uploads sync helper |
| `npm run probe:dev` / `probe:prod` | Test FTP/SFTP credentials |

## Cursor commands

| Command | Purpose |
|---------|---------|
| `/deploy-dev` | Commit → push `dev` → FTP theme to DEV |
| `/deploy-prod` | Merge `dev` → `main` → push → FTPS theme to PROD |
| `/import-db-dev` | **One-time** prod DB clone to DEV |

## Deploy theme to DEV

```bash
git checkout dev
npm run deploy:dev
```

Full tree sync (when git-only miss files):

```bash
DEPLOY_FULL=true DEPLOY_ALLOW_DIRTY=true npm run deploy:dev
```

## Deploy theme to PROD

```bash
git checkout main
npm run deploy:prod
```

Prefer `/deploy-prod` in Cursor for merge → push → deploy.

First full sync: `DEPLOY_FULL=true npm run deploy:prod`

## One-time DEV clone from prod backup

```bash
npm run import:db:dev
npm run import:uploads:dev
```

## Theme structure (short)

```
inc/               PHP helpers (enqueue, CPT, ACF, nav…)
template-parts/    Template fragments
parts/content/     ACF Flexible Content layouts
scss/              Layered source → npm run build:css → css/
  abstracts|base|layout|components|sections|pages|templates|bundles
js/main.js         Source JS → main.min.js
scripts/           Deploy + import
acf-json/          ACF field groups (partial)
```

Full map: [ARCHITECTURE.md](./ARCHITECTURE.md).

## GitHub

https://github.com/irynaBilousSPDev/Mudt_new.git

- `dev` — day-to-day + DEV deploy  
- `main` — production via `/deploy-prod`
