# Architecture — MUDT WordPress Theme (`Mudt_new`)

Where things live, what to edit, and how assets reach the browser.

## Quick map

| Need to change… | Edit here | Build / notes |
|-----------------|-----------|----------------|
| Global / header / home | `assets/src/scss/base|layout|sections|components/` | → `assets/dist/css/styles.css` |
| Flexible page sections (ACF) | `parts/content/*.php` + `assets/src/scss/sections|pages/` | → `page-styles.css` |
| Program / team singles | `template-parts/single-programs/` + `assets/src/scss/templates/` | → `single-styles.css` |
| JS | `assets/src/js/main.js` | → `assets/dist/js/` |
| Enqueue / supports | `inc/enqueue.php`, `functions.php` | no build |
| Build / gulp | `configure/gulpfile.js` | `npm run build` / `watch` |
| Deploy (optional) | `scripts/` + local `deploy.local.env` | never commit secrets |

**Never edit compiled `assets/dist/css/*.css` by hand.** Images stay in theme-root `images/`.

## Assets layout

```
assets/
├── src/
│   ├── scss/          # SOURCE (layered architecture)
│   └── js/main.js     # SOURCE
└── dist/
    ├── css/           # BUILD (+ fonts/ for @font-face)
    └── js/            # main.js + main.min.js
configure/
└── gulpfile.js
```

## SCSS architecture (no legacy layer)

```
assets/src/scss/
├── bundles/          # ONLY entrypoints (imported by Gulp)
├── abstracts/        # tokens
├── base/             # globals, utilities, titles, spacing, container, typography
├── layout/           # header, footer, sub-menu, mobile-menu, breadcrumbs
├── components/       # buttons, lists, offer-card, parallax, …
├── sections/         # one partial per UI / ACF section
├── templates/        # single-styles, page-pt, pre-bachelors
└── pages/            # custom-page, visa-guide, contact, …
```

**Cascade rule:** foundation partials load first; refined overrides load **after**.

## Directory tree (theme)

```
Mudt_new/
├── style.css / functions.php / header.php / footer.php
├── front-page.php, page*.php, single*.php, …
├── inc/
├── template-parts/ / parts/content/
├── assets/              # styles + scripts only (see above)
├── configure/gulpfile.js
├── images/              # static images (unchanged)
├── acf-json/
├── scripts/             # deploy, import, …
└── .cursor/commands/
```

## Production

| | |
|--|--|
| URL | uni-munich.de |
| Branch | `main` |
| Theme folder | `Mudt_new` |

Local secrets (if used): `deploy.local.env` (gitignored). Do not document staging hosts in this repo.

## Conventions

- New UI → `assets/src/scss/sections/` or `components/`, then `@use` from the right bundle.
- Do not reintroduce `scss/legacy/`.
- Commits in English; never commit `deploy.local.env`.

See [README.md](./README.md), [CONTRIBUTING.md](./CONTRIBUTING.md), [assets/src/scss/README.txt](./assets/src/scss/README.txt).
