/**
 * MUDT asset pipeline
 *
 * SOURCE:  assets/src/scss/  |  assets/src/js/main.js
 * OUTPUT:  assets/dist/css/  |  assets/dist/js/
 *
 * images/ stay at theme root — not part of this pipeline.
 */

const path = require('path');
const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const terser = require('gulp-terser');
const rename = require('gulp-rename');

const ROOT = path.join(__dirname, '..');
const SCSS_SRC = path.join(ROOT, 'assets/src/scss');
const SCSS_BUNDLES = path.join(SCSS_SRC, 'bundles');
const CSS_DEST = path.join(ROOT, 'assets/dist/css');
const JS_SRC = path.join(ROOT, 'assets/src/js/main.js');
const JS_DEST = path.join(ROOT, 'assets/dist/js');

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
    return src(BUNDLE_ENTRIES.map((file) => path.join(SCSS_BUNDLES, file)), {
        base: SCSS_BUNDLES,
        allowEmpty: false,
    })
        .pipe(sass.sync(sassOptions).on('error', sass.logError))
        .pipe(dest(CSS_DEST));
}

function scripts() {
    return src(JS_SRC, { allowEmpty: false })
        .pipe(dest(JS_DEST))
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest(JS_DEST));
}

function watchAssets() {
    watch([path.join(SCSS_SRC, '**/*.scss')], styles);
    watch([JS_SRC], scripts);
}

exports.styles = styles;
exports.scripts = scripts;
exports.build = parallel(styles, scripts);
exports.watch = series(exports.build, watchAssets);
exports.default = exports.watch;
