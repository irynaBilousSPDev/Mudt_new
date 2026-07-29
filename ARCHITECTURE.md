# Architecture — MUDT WordPress Theme (`Mudt_new`)

Where things live, what to edit, and how assets reach the browser.

## Quick map

| Need to change… | Edit here | Build / notes |
|-----------------|-----------|----------------|
| Global / header / home | `scss/base/`, `scss/layout/`, `scss/sections/`, `scss/components/` | `npm run build:css` → `css/styles.css` |
| Flexible page sections (ACF) | `parts/content/*.php` + `scss/sections/` + `scss/pages/` | → `css/page-styles.css` |
| Program / team singles | `template-parts/single-programs/` + `scss/templates/_single-styles.scss` | → `css/single-styles.css` |
| JS | `js/main.js` | → `js/main.min.js` |
| Enqueue / supports | `inc/enqueue.php`, `functions.php` | no build |
| Deploy | `scripts/deploy-dev.js` + `deploy.local.env` | `npm run deploy:dev` / `:prod` |

**Never edit compiled `css/*.css` by hand.**

## SCSS architecture (no legacy layer)

```
scss/
├── bundles/          # ONLY entrypoints (imported by Gulp)
│   ├── styles.scss       → css/styles.css
│   ├── page-styles.scss  → css/page-styles.css
│   ├── single-styles.scss→ css/single-styles.css
│   ├── footer.scss       → css/footer.css
│   ├── page-pt.scss      → css/page-pt.css
│   ├── reset.scss / fonts.scss
├── abstracts/        # tokens (:root variables)
├── base/             # globals, utilities, titles, spacing, container, typography
├── layout/           # header, footer(+classic), sub-menu, mobile-menu, breadcrumbs
├── components/       # buttons, lists, offer-card, parallax, price-date-card
├── sections/         # one partial per section / ACF block
├── templates/        # single-styles, page-pt, pre-bachelors
└── pages/            # custom-page, visa-guide, contact, request-info, …
```

**Cascade rule:** foundation partials load first in the bundle; refined overrides
(`sections/main-banner`, `tabs-slider`, `news`, …) load **after** so they win.

## Directory tree (theme)

```
Mudt_new/
├── style.css / functions.php / header.php / footer.php
├── front-page.php, page*.php, single*.php, index.php, 404.php
├── inc/                 # enqueue, CPT, ACF, nav, CF7…
├── template-parts/      # front-page/, single-programs/, …
├── parts/content/       # ACF Flexible Content layouts
├── scss/                # SOURCE (see above)
├── css/                 # BUILD output
├── js/main.js → main.min.js
├── images/
├── acf-json/
├── scripts/             # deploy, import, split-legacy-scss.js (historical)
└── .cursor/commands/
```

## Environments

| | Dev | Production |
|--|-----|------------|
| URL | iratest.site | uni-munich.de |
| Branch | `dev` | `main` |
| Theme folder | `Mudt_new` | `Mudt_new` |

Secrets: `deploy.local.env` (gitignored).

## Conventions

- New UI → new file under `sections/` or `components/`, then `@use` it from the right **bundle**.
- Do not reintroduce `scss/legacy/`.
- Same commit: avoid mixing pure moves with visual redesigns when possible.
- Commits in English; never commit `deploy.local.env`.

## Further cleanup (optional)

- Fold `*-base.scss` / `our-goals-legacy.scss` into their primary section files
- Peel `base/_responsive-misc.scss` rules into the matching section files
- Split `templates/_single-styles.scss` the same way sections were split

See [README.md](./README.md), [CONTRIBUTING.md](./CONTRIBUTING.md), [scss/README.txt](./scss/README.txt).
