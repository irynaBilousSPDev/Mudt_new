'use strict';

/**
 * MUDT theme asset pipeline
 *
 * SCSS entry points → css/*.css (same files WordPress enqueues)
 * js/main.js        → js/main.min.js
 *
 * Structure:
 *   scss/abstracts/   tokens, variables
 *   scss/base/          reset, container, spacing, fonts
 *   scss/layout/        header, footer
 *   scss/sections/      one partial per flexible / program section (migrate from legacy/)
 *   scss/templates/     single-program bundles still being split
 *   scss/pages/         page-template bundles (future splits from legacy/)
 *   scss/legacy/        monolith — shrink as sections move out
 */

const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const terser = require('gulp-terser');
const rename = require('gulp-rename');

const paths = {
    scss: {
        entries: [
            'scss/reset.scss',
            'scss/fonts.scss',
            'scss/footer.scss',
            'scss/page-pt.scss',
            'scss/styles.scss',
            'scss/page-styles.scss',
            'scss/single-styles.scss',
        ],
        watch: 'scss/**/*.scss',
    },
    js: {
        entry: 'js/main.js',
        watch: 'js/main.js',
        dest: 'js',
    },
    css: {
        dest: 'css',
    },
};

function styles() {
    return src(paths.scss.entries, { base: 'scss', allowEmpty: false })
        .pipe(
            sass
                .sync({
                    outputStyle: 'expanded',
                    sourceMap: false,
                    silenceDeprecations: ['legacy-js-api'],
                })
                .on('error', sass.logError)
        )
        .pipe(dest(paths.css.dest));
}

function scripts() {
    return src(paths.js.entry, { allowEmpty: false })
        .pipe(terser())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest(paths.js.dest));
}

function watchAssets() {
    watch(paths.scss.watch, styles);
    watch(paths.js.watch, scripts);
}

const build = parallel(styles, scripts);

exports.styles = styles;
exports.scripts = scripts;
exports.build = build;
exports.watch = series(build, watchAssets);
exports.default = exports.watch;
