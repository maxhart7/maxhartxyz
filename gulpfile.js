const { src, dest, parallel, series, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const imagemin = require('gulp-imagemin');
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const babel = require('gulp-babel');
const plumber = require('gulp-plumber');

// SRC Paths
const styleSource = 'src/styles/style.scss';
const imageSource = 'src/assets/**';
const scriptSource = 'src/scripts/**';

// Destination Paths
const stylePath = 'dist/styles';
const imagePath = 'dist/assets';
const scriptPath = 'dist/scripts';

const scripts = [
  'src/scripts/*.js',
];

function css () {
  return src(styleSource)
    .pipe(plumber())
    .pipe(sass())
    .pipe(autoprefixer({
      cascade: true,
    }))
    .pipe(cssnano())
    .pipe(dest(stylePath));
}

function js () {
  return src(scripts)
    .pipe(plumber())
    .pipe(concat('scripts.js'))
    .pipe(babel({ presets: ['@babel/preset-env'] }))
    .pipe(uglify({ mangle: false }))
    .pipe(dest(scriptPath));
}

function images () {
  return src(imageSource)
    .pipe(plumber())
    .pipe(
      imagemin([
        imagemin.svgo({
          plugins: [
            { removeViewBox: false },
         ]
       })
      ]))
    .pipe(dest(imagePath));
}

function watchFiles () {
  watch('src/styles/**/*.scss', parallel(css));
  watch('src/scripts/**.js', parallel(js));
  watch('src/assets/**', parallel(images));
}

exports.js = js;
exports.css = css;
exports.images = images;
exports.default = parallel(css, js, images, watchFiles);
exports.watch = watchFiles;
