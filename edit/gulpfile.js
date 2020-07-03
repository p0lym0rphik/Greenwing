var gulp = require('gulp'),
    sass = require('gulp-sass'),
    cleanCss = require('gulp-clean-css'),
    sourcemaps = require('gulp-sourcemaps'),
    clean = require('gulp-clean'),
    autoprefixer = require('gulp-autoprefixer'),
    rev = require('gulp-rev'),
    browserSync = require('browser-sync').create(),
    { series } = require('gulp');
    paths = {
      host: 'localhost:8040',
      dest: 'dist',
      mainScss: 'sass/main.scss',
      scss: 'sass/**/*.scss',
    }

function style() {
  return (
    gulp
      .src(paths.mainScss)
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(autoprefixer("last 2 versions", "> 1%", "Explorer 7", "Android 2"))
      .pipe(cleanCss())
      .pipe(rev())
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest(paths.dest))
      .pipe(rev.manifest())
      .pipe(gulp.dest(paths.dest))
  )
}

function serve(done) {
  browserSync.init({
    proxy: paths.host
  });
  done();
}

function clearDist(done) {
  return (
    gulp
      .src(['dist', 'build/dist', 'build/src'], {allowEmpty: true})
      .pipe(clean())
  )
}

function reload(done) {
  browserSync.reload();
  done();
}

function watch() {
  gulp.watch([paths.scss], gulp.series(clearDist, style, reload));
}

exports.watch = series(clearDist, style, serve, watch);
