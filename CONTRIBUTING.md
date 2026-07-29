# Contributing — MUDT Theme

## Setup

```bash
npm install
npm run watch    # SCSS + JS while developing
```

Optional deploy secrets: copy `deploy.local.env.example` → `deploy.local.env` locally — **never commit** that file.

## Making changes

1. Edit **source** only: PHP templates, `assets/src/scss/`, `assets/src/js/main.js`, `inc/`.
2. Rebuild when needed: `npm run build` (or rely on `watch`).
3. Keep changes focused; notes in **English**.

### SCSS rules

- Prefer `assets/src/scss/sections/` or `components/` for new UI.
- Do not hand-edit `assets/dist/css/*.css`.
- Do **not** recreate `scss/legacy/`.
- Wire new partials with `@use` from the correct file in `assets/src/scss/bundles/`.

## Checklist

- [ ] No secrets in the change set
- [ ] CSS came from SCSS build
- [ ] Hard-refresh / `filemtime` cache considered after deploy
- [ ] Mobile viewport checked for typography / layout changes

## Questions

Project overview: [README.md](./README.md)  
Structure: [ARCHITECTURE.md](./ARCHITECTURE.md)
