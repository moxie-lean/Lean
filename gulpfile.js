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
var phpcbf = require('gulp-phpcbf');
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

// Tasks that are handle the lints without breaking the gulp report
gulp.task('js:lint', ['js:hint', 'js:cs']);

// JS hint to explore the errors in the JS file using jshintrc
gulp.task('js:hint', function() {
  return gulp.src( jsFiles )
  .pipe(jshint('.jshintrc'))
  .pipe(jshint.reporter('default'))
  .pipe( notify({ message: 'JSHint complete', onLast: true }) );
});

/**
 * Task for continious integration using jshintrc, it will exit with code 1 if
 * there is an error in the JS files compared with the rules from .jshintrc
 */
gulp.task('js:hint-ci', function() {
  return gulp.src( jsFiles )
  .pipe(jshint('.jshintrc'))
  .pipe(jshint.reporter('default'))
  .pipe(jshint.reporter('fail'));
});

// Gulp taks to analyze the code using JS CS rules witouth breaking gulp
gulp.task('js:cs', function() {
  return gulp.src( jsFiles )
  .pipe(jscs())
  .pipe( notify({ message: 'JSCS complete', onLast: true }) );
});

// Tasks for continuous integration using the JS CS rules
gulp.task('js:cs-ci', function() {
  return gulp.src( jsFiles )
  .pipe(jscs())
  .pipe(jscs.reporter())
  .pipe(jscs.reporter('fail'));
});

// Group of JS tasks for continuous integration
gulp.task('js:ci', ['js:hint-ci', 'js:cs-ci']);

/******************************************************************************
| >   PHP TASKS
******************************************************************************/
// Files where the code sniffer should run
var phpFiles = [
  '*.php',
  'lib/*.php',
  'lib/*/*.php',
  'config/*.php',
  'page-templates/*.php',
  'page-templates/*.php',
  'partials/*.php'
];
// Options for the code sniffer
var phpOptions = {
  bin: './vendor/bin/phpcs',
  standard: './codesniffer.ruleset.xml',
  colors: true,
};
// Lint that does not break gulp
// Lint taks to inspect PHP files in order to follow WP Standards
 gulp.task('php:lint', function () {
 return gulp.src( phpFiles )
  .pipe(phpcs( phpOptions ))
  .pipe(phpcs.reporter('log'))
  .pipe( notify({ message: 'php sniffer complete', onlast: true }) );
});

// Generate an error if there is a mistakte on PHP
gulp.task('php:ci', function () {
  return gulp.src( phpFiles )
  .pipe(phpcs( phpOptions ))
  .pipe(phpcs.reporter('log'))
  .pipe(phpcs.reporter('fail'));
});

// task to inspect and FIX PHP files
gulp.task('php:fix', function () {
  return gulp.src( phpFiles )
  .pipe(phpcbf( phpOptions ))
  .pipe(phpcbf.reporter('log'))
  .pipe(phpcbf.reporter('fail'))
  .pipe(phpcbf( phpOptions ))
  .pipe(phpcbf.reporter('log'))
  .pipe( notify({ message: 'php sniffer complete', onlast: true }) );
});

/******************************************************************************
| >   WATCH TASKS
******************************************************************************/
gulp.task('watch:all', ['watch:php', 'watch:js', 'watch:sass']);

gulp.task('watch:php', ['php:lint'], function(){
  gulp.watch( phpFiles, ['php:lint'] );
});

gulp.task('watch:js', ['js'], function(){
  gulp.watch(source + 'js/app/**/*.js', ['js']);
});

gulp.task('watch:sass', ['js'], function(){
  gulp.watch(source + 'sass/**/*.scss', ['styles']);
});

/******************************************************************************
| >   CONTINUOUS INTEGRATION TASK
******************************************************************************/
gulp.task('ci', ['js:ci', 'php:ci']);

/******************************************************************************
| >   DEFAULT TASK
******************************************************************************/
gulp.task('default', ['watch:js', 'watch:sass']);

