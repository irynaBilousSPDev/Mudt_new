# MUDT WordPress Theme (Mudt_new)

Custom theme for **Munich University of Digital Technologies & Applied Sciences**.

| Doc | Purpose |
|-----|---------|
| [ARCHITECTURE.md](./ARCHITECTURE.md) | Folders, SCSS bundles, where to edit |
| [CONTRIBUTING.md](./CONTRIBUTING.md) | Branches, commits, workflow |
| [CHANGELOG.md](./CHANGELOG.md) | Version history |
| [LICENSE](./LICENSE) | Proprietary — all rights reserved |
| [assets/src/scss/README.txt](./assets/src/scss/README.txt) | SCSS notes |

Production site: **uni-munich.de**. Remote theme folder: **`Mudt_new`**.

## Requirements

- WordPress 6+
- PHP 8.0+ recommended
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- Contact Form 7
- Node.js 18+ (local build only)

## Local setup

```bash
npm install
npm run watch    # rebuild CSS/JS on change
# or
npm run build    # one-shot CSS + JS
```

### NPM scripts

| Script | Action |
|--------|--------|
| `npm run build` | Compile all SCSS bundles + minify `main.js` |
| `npm run build:css` | SCSS → `assets/dist/css/` |
| `npm run build:js` | `assets/src/js/main.js` → `assets/dist/js/` |
| `npm run watch` | Watch SCSS + JS |

Deploy helpers (optional, local secrets only — never commit `deploy.local.env`):

| Script | Action |
|--------|--------|
| `npm run deploy:prod` | Upload theme to production |
| `npm run probe:prod` | Test production FTP/SFTP credentials |

## Theme structure (short)

```
inc/               PHP helpers (enqueue, CPT, ACF, nav…)
template-parts/    Template fragments
parts/content/     ACF Flexible Content layouts
assets/src/scss/   Source → npm run build:css → assets/dist/css/
assets/src/js/     Source → assets/dist/js/
configure/         gulpfile.js
images/            Static images (not in assets pipeline)
scripts/           Optional local tooling
acf-json/          ACF field groups (partial)
```

Full map: [ARCHITECTURE.md](./ARCHITECTURE.md).
