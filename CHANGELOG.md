# Changelog — MUDT Theme

All notable changes to this theme are documented here.

Format inspired by [Keep a Changelog](https://keepachangelog.com/).
Version numbers follow the WordPress `style.css` **Version** header.

## [7.0.3] — 2026-07-29

### Added

- Theme docs: `ARCHITECTURE.md`, `CONTRIBUTING.md`, `LICENSE`, `SECURITY.md`, `.editorconfig`
- Shared tabs / specialisations accordion on mobile (`scss/sections/_tabs-slider.scss`)
- Homepage slider: hide `wrapper_date_open_day` when session date/time has passed
- Assets layout: `assets/src/{scss,js}` → `assets/dist/{css,js}` (+ `configure/gulpfile.js`)

### Changed

- **SCSS architecture:** removed hybrid `scss/legacy/` — monoliths split into `base/`, `layout/`, `components/`, `sections/`, `pages/`, `templates/`
- AOS + tabs accordion enter animation: play once only
- Mobile typography tightened on program sections (career paths, why study, campus bottom)
- Why Study: 2-column icon grid on mobile with larger icons
- Page header: fixed dark arc on white title card (radius / underlay)
- Contact / “Book a Campus Tour”: form padding clear of blue panel curve; softer radius
- Info Sessions CTA (“next sessions”): theme-aligned pill button
- Tabs desktop: navy content pane stretches to match tab list height

### Fixed

- Tabs slider empty height from inactive panels (`display: none` instead of `max-height: 0`)
- SCSS brace balance / build reliability after legacy split

## [7.0.2] — 2026-07

### Changed

- SCSS pipeline via Gulp bundles; partial extraction from legacy monolith
- DEV/PROD deploy scripts (local tooling; secrets not in repo)
- Section spacing tokens (`scss/abstracts/_variables.scss`, `base/_section-spacing.scss`)

## [7.0.0] — earlier

### Added

- Custom theme for Munich University of Digital Technologies
- ACF Flexible Content layouts, program CPTs, CF7 integration
