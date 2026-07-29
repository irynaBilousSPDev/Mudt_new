/**
 * One-shot: split scss/legacy monoliths into architecture folders, then retire legacy/.
 * Run: node scripts/split-legacy-scss.js
 */
'use strict';

const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..', 'assets', 'src', 'scss');

function readLines(rel) {
  const p = path.join(ROOT, rel);
  return fs.readFileSync(p, 'utf8').split(/\r?\n/);
}

function writeExtract(outRel, lines, ranges, header) {
  const parts = [];
  for (const [a, b] of ranges) {
    parts.push(lines.slice(a - 1, b).join('\n').trimEnd());
  }
  const out = path.join(ROOT, outRel);
  fs.mkdirSync(path.dirname(out), { recursive: true });
  const body = parts.filter(Boolean).join('\n\n');
  const banner = header ? `${header}\n\n` : '';
  fs.writeFileSync(out, banner + body + '\n');
  const count = body.split(/\n/).length;
  console.log('✓', outRel, `(~${count} lines)`);
}

function main() {
  const styles = readLines('legacy/_styles.scss');
  const pages = readLines('legacy/_page-styles.scss');
  console.log('Source: styles', styles.length, 'page-styles', pages.length);

  // —— styles.css bundle (was legacy/_styles.scss) ——
  writeExtract('base/_globals.scss', styles, [[1, 42]]);
  writeExtract('base/_utilities.scss', styles, [[44, 48]]);
  writeExtract('components/_buttons.scss', styles, [[50, 171]]);
  writeExtract('components/_lists.scss', styles, [
    // list / link scraps often near buttons — take remaining through section_title start
    [172, 176],
  ]);
  // section_title / sub_title → append into typography via separate file to avoid fighting existing
  writeExtract('base/_titles.scss', styles, [[177, 194]]);
  writeExtract('layout/_header.scss', styles, [
    [196, 650],
    [2527, 2795],
  ]);
  writeExtract('layout/_sub-menu.scss', styles, [[651, 682]]);
  writeExtract('sections/_offer-nav.scss', styles, [[684, 839], [1146, 1151]]);
  writeExtract('sections/_slider.scss', styles, [[841, 1142]]);
  // numbers leftovers — merge file (small)
  writeExtract('sections/_numbers-count-base.scss', styles, [[1144, 1188]]);
  writeExtract('sections/_offers-tabs.scss', styles, [[1191, 1303]]);
  writeExtract('components/_offer-card.scss', styles, [[1304, 1556]]);
  writeExtract('sections/_video-lecturers.scss', styles, [[1558, 1767]]);
  writeExtract('sections/_cooperation.scss', styles, [[1769, 1827]]);
  writeExtract('sections/_news-base.scss', styles, [[1829, 2090]]);
  writeExtract('sections/_tabs-base.scss', styles, [[2093, 2391]]);
  writeExtract('layout/_footer-classic.scss', styles, [[2394, 2525]]);
  // kitchen-sink responsive leftovers (visa/campus/etc. overrides that lived in styles.css)
  writeExtract('base/_responsive-misc.scss', styles, [[2796, styles.length]]);

  // —— page-styles.css bundle (was legacy/_page-styles.scss) ——
  writeExtract('components/_parallax.scss', pages, [[1, 48]]);
  writeExtract('pages/_custom-page.scss', pages, [[49, 146]]);
  writeExtract('sections/_admission-requirements.scss', pages, [[147, 157]]);
  writeExtract('sections/_language.scss', pages, [
    [159, 166],
    [521, 532],
  ]);
  writeExtract('sections/_application-steps.scss', pages, [[167, 226]]);
  writeExtract('sections/_fees.scss', pages, [[228, 424]]);
  writeExtract('base/_header-offset.scss', pages, [[426, 517]]);
  writeExtract('sections/_our-goals-legacy.scss', pages, [[534, 561]]);
  writeExtract('sections/_specialisation-main.scss', pages, [[565, 597]]);
  writeExtract('sections/_campus.scss', pages, [[599, 743]]);
  writeExtract('sections/_scholarships-financing.scss', pages, [[745, 835]]);
  writeExtract('components/_price-date-card.scss', pages, [[837, 895]]);
  writeExtract('sections/_text-image.scss', pages, [[897, 943]]);
  writeExtract('sections/_bg-image.scss', pages, [[945, 1036]]);
  writeExtract('sections/_video.scss', pages, [[1038, 1069]]);
  writeExtract('pages/_request-info-material.scss', pages, [[1071, 1156]]);
  writeExtract('pages/_visa-guide.scss', pages, [[1158, 1431]]);
  writeExtract('sections/_application-deadlines.scss', pages, [[1433, 1649]]);
  writeExtract('sections/_scholarships.scss', pages, [[1651, 1661]]);
  writeExtract('pages/_contact.scss', pages, [[1663, 1736]]);
  writeExtract('templates/_pre-bachelors.scss', pages, [[1738, 1773]]);
  writeExtract('sections/_program-benefits.scss', pages, [[1775, 1988]]);
  writeExtract('pages/_page-responsive-misc.scss', pages, [[1990, pages.length]]);

  console.log('\nDone extracting. Next: update bundles + remove legacy uses.');
}

main();
