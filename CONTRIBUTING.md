# Contributing — MUDT Theme

## Branches

| Branch | Use |
|--------|-----|
| `dev` | Day-to-day work; deploys to **iratest.site** |
| `main` | Production; deploy only via `/deploy-prod` (merge `dev` → `main`) |

## Setup

```bash
cp deploy.local.env.example deploy.local.env   # fill secrets — never commit
npm install
npm run watch                                  # SCSS + JS while developing
```

## Making changes

1. Work on `dev`.
2. Edit **source** only: PHP templates, `assets/src/scss/`, `assets/src/js/main.js`, `inc/`.
3. Rebuild when needed: `npm run build` (or rely on `watch`).
4. Keep commits focused; messages in **English**.

### SCSS rules

- Prefer `assets/src/scss/sections/` or `components/` for new UI.
- Do not hand-edit `assets/dist/css/*.css`.
- Do **not** recreate `scss/legacy/`.
- Wire new partials with `@use` from the correct file in `assets/src/scss/bundles/`.
- Avoid renaming selectors in the same commit as a large move when possible.

## Commit / push / deploy

**Never commit** `deploy.local.env`.

Cursor commands (preferred):

| Command | What it does |
|---------|----------------|
| `/deploy-dev` | Commit (if needed) → push `dev` → SFTP theme to DEV |
| `/deploy-prod` | Merge `dev` → `main` → push → FTPS theme to PROD |
| `/import-db-dev` | One-time prod DB → DEV (not part of normal deploy) |

Manual DEV deploy:

```bash
git checkout dev
npm run deploy:dev
```

Full sync / dirty tree (when needed):

```bash
DEPLOY_FULL=true DEPLOY_ALLOW_DIRTY=true npm run deploy:dev
```

## Pull requests

- Target `dev` for feature work.
- Describe **why**, list pages/sections to smoke-test, note mobile if relevant.
- After merge to `dev`, deploy DEV before promoting to prod.

## Code review checklist

- [ ] No secrets in the diff
- [ ] CSS came from SCSS build
- [ ] Hard-refresh / `filemtime` cache considered on DEV
- [ ] Mobile viewport checked for typography / layout changes

## Questions

Project overview: [README.md](./README.md)  
Structure: [ARCHITECTURE.md](./ARCHITECTURE.md)
