'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
 
sass.compiler = require('node-sass');

var src = {
    php: 'src/**/*.php',
    sass: 'src/kmw-fs/sass/**/*.scss',
    js: 'src/kmw-fs/js/*.js',
}

var dist = {
    php: 'dist',
    sass: 'dist/kmw-fs/css/',
    js: 'dist/kmw-fs/js/',
}

var dist = {
    php: 'dist',
    sass: 'dist/kmw-fs/css/',
    js: 'dist/kmw-fs/js/',
    fonts: 'dist/kmw-fs/fonts/',
}

var vendor = {
    fontawesome: {
        fonts: './node_modules/font-awesome/fonts/*',
        css: './node_modules/font-awesome/css/font-awesome.min.css',
    },
}

// copy all the PHP and put it into dist CSS folder
gulp.task('php', function () {
return gulp.src( src.php )
    .pipe(gulp.dest('dist'));
});

// compile all the Sass and put it into dist CSS folder
gulp.task('sass', function () {
  return gulp.src(src.sass)
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest(dist.sass));
});

// concatenate all the JS and put it into dist JS folder
gulp.task('js', function(){
  return gulp.src(src.js)
    .pipe(sourcemaps.init())
    .pipe(concat('script.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(dist.js))
});

// copy fontawesome from node_modules into dist Fonts folder
gulp.task('fonts', function () {
  return gulp.src(vendor.fontawesome.fonts)
    .pipe(gulp.dest(dist.fonts));
});

// copy fontawesome css from node_modules into dist Fonts folder
gulp.task('fonts-css', function () {
  return gulp.src(vendor.fontawesome.css)
    .pipe(gulp.dest(dist.sass));
});

// copy fontawesome css from node_modules into dist Fonts folder
gulp.task('watch', function() {
    gulp.watch(src.php, ['php']);
    gulp.watch(src.sass, ['sass']);
    gulp.watch(src.js, ['js']);
});


gulp.task('default', [ 'php', 'sass', 'js', 'fonts', 'fonts-css' ]);