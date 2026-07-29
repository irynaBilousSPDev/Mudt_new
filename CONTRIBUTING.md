# Contributing — MUDT Theme

## Branches

| Branch | Use |
|--------|-----|
| `dev` | Day-to-day work |
| `main` | Production |

## Setup

```bash
npm install
npm run watch    # SCSS + JS while developing
```

Optional deploy secrets: copy `deploy.local.env.example` → `deploy.local.env` locally — **never commit**.

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

## Commit / push

**Never commit** `deploy.local.env`.

Promote to production via merge `dev` → `main` when ready.

## Pull requests

- Target `dev` for feature work.
- Describe **why**, list pages/sections to smoke-test, note mobile if relevant.

## Code review checklist

- [ ] No secrets in the diff
- [ ] CSS came from SCSS build
- [ ] Hard-refresh / `filemtime` cache considered after deploy
- [ ] Mobile viewport checked for typography / layout changes

## Questions

Project overview: [README.md](./README.md)  
Structure: [ARCHITECTURE.md](./ARCHITECTURE.md)
