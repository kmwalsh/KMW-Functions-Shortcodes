'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
 
sass.compiler = require('node-sass');

// copy all the PHP and put it into dist CSS folder
gulp.task('php', function () {
return gulp.src('src/**/*.php')
    .pipe(gulp.dest('dist'));
});

// compile all the Sass and put it into dist CSS folder
gulp.task('sass', function () {
  return gulp.src('src/kmw-fs/sass/app.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('dist/kmw-fs/css/'));
});

// concatenate all the JS and put it into dist JS folder
gulp.task('js', function(){
  return gulp.src('src/kmw-fs/js/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('script.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist/kmw-fs/js/'))
});

// copy fontawesome from node_modules into dist Fonts folder
gulp.task('fonts', function () {
  return gulp.src('./node_modules/font-awesome/fonts/*')
    .pipe(gulp.dest('dist/kmw-fs/fonts/'));
});

// copy fontawesome css from node_modules into dist Fonts folder
gulp.task('fonts-css', function () {
  return gulp.src('./node_modules/font-awesome/css/font-awesome.min.css')
    .pipe(gulp.dest('dist/kmw-fs/css/'));
});

gulp.task('default', [ 'php', 'sass', 'js', 'fonts', 'fonts-css' ]);
          