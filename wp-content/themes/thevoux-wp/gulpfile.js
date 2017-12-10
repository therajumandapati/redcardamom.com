(function() {
  'use strict';

  var gulp = require('gulp'),
      sequence = require('gulp-sequence'),
      phplint = require('gulp-phplint');

  /*
   * Check if we have errors in php files
   */
  gulp.task('phplint', function() {
      return gulp.src(['**/**/*.php', '!vendor/**', '!node_modules/**'])
          .pipe(phplint())
          .pipe(phplint.reporter());
  });
  // Default Gulp Task
  gulp.task('build', sequence('phplint'));

}());
