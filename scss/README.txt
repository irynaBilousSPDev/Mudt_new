/**
 * SCSS entry map (D — 1:1 migration).
 *
 * Build: npm run build:css
 * Output: existing css/*.css (enqueue unchanged).
 *
 * Next slices (DEV only, one at a time):
 *   layout/_header.scss
 *   sections/_<{acf_layout}>.scss  → then wire into page-styles / styles entries
 *   templates/_front-page.scss, _single-programs.scss, _page-pt.scss
 *
 * Done: reset, fonts, footer, page-pt, single-styles, styles, page-styles (legacy blobs)
 * Next (optional): peel header / flexible sections out of legacy into scss/sections/
 * Rules: no selector renames, no visual refactors in the same commit as a move.
 */
