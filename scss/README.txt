/**
 * SCSS source — MUDT theme (layered architecture, no legacy/)
 *
 * Build:  npm run build:css  |  npm run watch
 * Output: css/*.css (enqueued in inc/enqueue.php) — never edit CSS by hand
 *
 * See ../ARCHITECTURE.md
 *
 * bundles/     Gulp entrypoints only
 * abstracts/   Design tokens
 * base/        Globals, utilities, titles, spacing, container, typography
 * layout/      Header, footer, sub-menu, mobile-menu, breadcrumbs
 * components/  Shared UI (buttons, cards, parallax, …)
 * sections/    One file per section / ACF block
 * templates/   Template sheets (single, page-pt, pre-bachelors)
 * pages/       Page-template shells (visa, contact, custom-page, …)
 *
 * Historical split tool: scripts/split-legacy-scss.js
 */
