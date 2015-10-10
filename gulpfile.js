'use strict';
/******************************************************************************
| >   PLUGINS
******************************************************************************/
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var jshint = require('gulp-jshint');
var jscs = require('gulp-jscs');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');
var phpcs = require('gulp-phpcs');
var sass = require('gulp-sass');
/******************************************************************************
| >   PROJECT VARIABLES
******************************************************************************/
var project = '.';
var source = project + '/assets/';
var bower = project + '/bower_components/';

/******************************************************************************
| >   CSS TASKS
******************************************************************************/

/**
 * Run the minify:styles task as dependency, which will compile from sass,
 * will generate a source map and then minify the result css.
 */
gulp.task('styles', ['styles:minify'], function() {
  var styles = [
    source + 'css/style.css',
    source + 'css/style-min.css'
  ];
  return gulp.src(styles)
  .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});

/**
 * Minify the CSS after has been created with source maps, styles:minify
 * is a depnency after this task it's completed it's going to minify
 * the CSS.
 */
gulp.task('styles:minify', ['styles:combine'], function(){
  return gulp.src(source + 'css/style.css')
  .pipe(minifycss({ keepBreaks: true }))
  .pipe(minifycss({ keepSpecialComments: 0 }))
  .pipe(rename({ suffix: '-min' }))
  .pipe(gulp.dest(source + 'css'));
});

/**
 * Task to compile the CSS from sass, this will add the prefixes and creates the
 * sourcemap, this source map is going to be loaded only in the non minified
 * version.
 */
gulp.task('styles:combine', function(){
  return gulp.src(source + 'sass/style.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(autoprefixer(
    'last 2 version',
    'safari 5', 'ie 8',
    'ie 9',
    'opera 12.1',
    'ios 6',
    'android 4'
  ))
  .pipe(sourcemaps.write('../maps'))
  .pipe(gulp.dest(source + 'css'));
});

/******************************************************************************
| >   JS TASKS
******************************************************************************/

// Task to combine and minify the js scripts.
gulp.task('js', ['js:minify'], function() {
  return gulp.src( source + 'js/production.js')
  .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * Runs a minify task to combine and minify the scripts after are combined in
 * a single file stored in js as production.js
 */
gulp.task('js:minify', ['js:combine'], function(){
  return gulp.src(source + 'js/production.js')
  .pipe(rename({ suffix: '-min' }))
  .pipe(uglify())
  .pipe(gulp.dest(source + 'js'));
});

/**
 * Combines all the files in the scripts array, and creates a source map for the
 * generated file to easy access to the original files from the browser to
 * enable faster development process.
 */
gulp.task('js:combine', function(){
  var scripts = [
    bower + 'essential.js/essential.js',
    source + 'js/app/main.js',
    source + 'js/app/behaviors/*.js',
  ];
  return gulp.src( scripts )
  .pipe(sourcemaps.init())
  .pipe(concat('production.js'))
  .pipe(sourcemaps.write('../maps'))
  .pipe(gulp.dest(source + 'js'));
});

// Files to inspect in order to follow the same standard
var jsFiles = [
    source + 'js/app/*.js',
    source + 'js/app/behaviors/*.js',
];

gulp.task('js:lint', ['js:hint', 'js:cs']);

gulp.task('js:hint', function() {
  return gulp.src( jsFiles )
  .pipe(jshint('.jshintrc'))
  .pipe(jshint.reporter('default'))
  .pipe( notify({ message: 'JSHint complete', onLast: true }) );
});

gulp.task('js:cs', function() {
  return gulp.src( jsFiles )
  .pipe(jscs())
  .pipe( notify({ message: 'JSCS complete', onLast: true }) );
});

/******************************************************************************
| >   PHP TASKS
******************************************************************************/
var phpFiles = [
  '*.php',
  'lib/*.php',
  'lib/*/*.php',
  'config/*.php',
  'page-templates/*.php',
  'page-templates/*.php',
  'partials/*.php'
];

// Lint taks to inspect PHP files in order to follow WP Standards
gulp.task('php:lint', function () {
  var options = {
    bin: './vendor/bin/phpcs',
    standard: './codesniffer.ruleset.xml',
    colors: true,
  };
  return gulp.src( phpFiles )
  .pipe(phpcs(options))
  .pipe(phpcs.reporter('log'))
  .pipe( notify({ message: 'PHP Sniffer Complete', onLast: true }) );
});


/******************************************************************************
| >   WATCH TASKS
******************************************************************************/
gulp.task('watch:php', ['php:lint'], function(){
  gulp.watch( phpFiles, ['php'] );
});

/******************************************************************************
| >   DEFAULT TASK
******************************************************************************/
gulp.task('default', ['styles', 'js'], function() {
  gulp.watch(source + 'sass/**/*.scss', ['styles']);
  gulp.watch(source + 'js/app/**/*.js', ['js']);
});

