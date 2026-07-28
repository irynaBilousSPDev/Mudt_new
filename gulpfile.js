'use strict';

/**
 * MUDT asset pipeline
 *
 * SOURCE (edit):  scss/
 *   bundles/      entry files only → map 1:1 to css/*.css
 *   abstracts/    variables
 *   base/         reset, fonts, container, spacing
 *   layout/       header, footer
 *   sections/     one file per section block
 *   templates/    template-specific partials
 *   pages/        page-template partials (future)
 *   legacy/       monolith being split — do not add new code here
 *
 * OUTPUT (build): css/*.css  — never edit by hand
 * JS:              js/main.js → js/main.min.js
 */

const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const terser = require('gulp-terser');
const rename = require('gulp-rename');

const SCSS_SRC = 'scss';
const SCSS_BUNDLES = `${SCSS_SRC}/bundles`;
const CSS_DEST = 'css';
const JS_SRC = 'js/main.js';
const JS_DEST = 'js';

const BUNDLE_ENTRIES = [
    'reset.scss',
    'fonts.scss',
    'footer.scss',
    'page-pt.scss',
    'styles.scss',
    'page-styles.scss',
    'single-styles.scss',
];

const sassOptions = {
    outputStyle: 'expanded',
    sourceMap: false,
    silenceDeprecations: ['legacy-js-api'],
    loadPaths: [SCSS_SRC],
};

function styles() {
    return src(BUNDLE_ENTRIES.map((file) => `${SCSS_BUNDLES}/${file}`), {
        base: SCSS_BUNDLES,
        allowEmpty: false,
    })
        .pipe(sass.sync(sassOptions).on('error', sass.logError))
        .pipe(dest(CSS_DEST));
}

function scripts() {
    return src(JS_SRC, { allowEmpty: false })
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest(JS_DEST));
}

function watchAssets() {
    watch(`${SCSS_SRC}/**/*.scss`, styles);
    watch(JS_SRC, scripts);
}

const build = parallel(styles, scripts);

exports.styles = styles;
exports.scripts = scripts;
exports.build = build;
exports.watch = series(build, watchAssets);
exports.default = exports.watch;
