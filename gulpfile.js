'use strict';

// Set up a general path to the current project
var project = '.';
var build = project + './build/';

// Your main project assets and naming 'source' instead of 'src' to avoid
// confusion with gulp.src
var source = project + '/assets/';
var bower = project + '/bower_components/';

// Load plugins
var gulp = require('gulp');
var browserSync	= require('browser-sync');
var reload = browserSync.reload;
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var jshint = require('gulp-jshint');
var jscs = require('gulp-jscs');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');

// Our Sass compiler
var sass = require('gulp-sass');
var del = require('del');

gulp.task('browser-sync', function() {
  var files = [
    '**/*.php',
  ];

  browserSync.init(files, {
    proxy: project + '.dev',
  });
});

/**
 * Run the minify-css gulp task as dependency, which will compile from sass,
 * generate a source map and then minifies the result css.
 */
gulp.task('styles', ['minify-css'], function() {
  var styles = [source + 'css/style.css', source + 'css/style-min.css'];
  return gulp.src(styles)
  .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});

/**
 * Minify the CSS after has been created with the source maps, has as the task
 * compile-css as a depnency after this task it's completed it's going to minify
 * the CSS.
 */
gulp.task('minify-css', ['compile-css'], function(){
  return gulp.src(source + 'css/style.css')
    .pipe(minifycss({ keepBreaks: true }))
    .pipe(minifycss({ keepSpecialComments: 0 }))
    .pipe(rename({ suffix: '-min' }))
    .pipe(gulp.dest(source + 'css'));
});

/**
 * Task to compile the CSS from sass, adss the prefixes and creates the
 * sourcempas for debug purposes only for the not minified version of this style
 */
gulp.task('compile-css', function(){
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

/**
 * Task to combine and minify the js scripts.
 */
gulp.task('js', ['minify-js'], function() {
  return gulp.src( source + 'js/production.js')
  .pipe(notify({ message: 'Scripts task complete', onLast: true }));
});

/**
 * Runs a minify task to combine and minify the scripts after are combined in
 * a single file stored in js as production.js
 */
gulp.task('minify-js', ['combine-js'], function(){
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
gulp.task('combine-js', function(){
  var scripts = [
    bower + 'essential.js/essential.js',
    source + 'js/app/main.js',
    source + 'js/app/init.js',
    source + 'js/app/base.js',
    source + 'js/app/!(base).js',
    source + 'js/app/behaviors/*.js',
  ];
  return gulp.src( scripts )
  .pipe(sourcemaps.init())
  .pipe(concat('production.js'))
  .pipe(sourcemaps.write('../maps'))
  .pipe(gulp.dest(source + 'js'));
});

/**
* jsHint Tasks
*
* Scan our own JS code excluding vendor JS libraries and perform jsHint task.
*/
gulp.task('review-js', ['js-hint', 'js-cs']);

gulp.task('js-hint', function() {
  return gulp.src([
    source + 'js/app/*.js',
    source + 'js/app/behaviors/*.js',
  ])
  .pipe(jshint('.jshintrc'))
  .pipe(jshint.reporter('default'));
});

gulp.task('js-cs', function() {
  return gulp.src([
    source + 'js/app/*.js',
    source + 'js/app/behaviors/*.js',
  ])
  .pipe(jscs());
});

/**
 * Clean
 *
 * Being a little overzealous, but we're cleaning out the build folder,
 * codekit-cache directory and annoying DS_Store files and Also
 * clearing out unoptimized image files in zip as those will have been moved
 * and optimized
 */
gulp.task('cleanup', function(cb) {
  return del([
    '**/build',
bower,
'./library/vendors/composer',
'**/.sass-cache',
'**/.codekit-cache',
'**/.DS_Store',
'!node_modules/**',
  ], cb);
});

gulp.task('cleanupFinal', function(cb) {
  return del([
    '**/build',
    bower, '**/.sass-cache',
    '**/.codekit-cache',
    '**/.DS_Store',
    '!node_modules/**',
      ], cb);
});

/**
* Build task that moves essential theme files for production-ready sites
*
* First, we're moving PHP files to the build folder for redistribution.
* Also we're excluding the library, build and src directories. Why?
* Excluding build prevents recursive copying and Inception levels of bullshit.
* We exclude library because there are certain non-php files there that need
* to get moved as well. So I put the library directory into its own task.
* Excluding src because, well, we don't want to * distribute
* uniminified/unoptimized files. And, uh, grabbing screenshot.png
* cause I'm janky like that!
*/
gulp.task('buildPhp', function() {
  return gulp.src([
    '**/*.php',
    './style.css',
    './gulpfile.js',
    './package.json',
    './.bowercc',
    '.gitignore',
    './screenshot.png',
    '!./build/**',
    '!./library/**',
    '!./src/**',
  ])
  .pipe(gulp.dest(build))
  .pipe(notify({ message: 'Moving files complete', onLast: true }));
});

// ==== TASKS ==== //
// Package Distributable Theme
gulp.task('default', ['styles', 'js', 'jsHint', 'browser-sync'], function() {
  gulp.watch(source + 'sass/**/*.scss', ['styles']);
  gulp.watch(source + 'js/app/**/*.js', ['js', reload]);
  gulp.watch(source + 'js/app/**/*.js', ['jsHint']);
});
