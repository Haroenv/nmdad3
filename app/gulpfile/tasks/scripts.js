/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let concat = require('gulp-concat'),
        ngAnnotate = require('gulp-ng-annotate');

    // Concatenate all scripts to `./www/js/app.js`.
    gulp.task('scripts', scripts);
    function scripts() {
        return gulp
            .src([
                './src/**/*.module.js', // Must be placed first!
                './src/**/*.run.js',    // Must be placed second!
                './src/**/*.js'
            ])
            .pipe(concat('app.js'))
            .pipe(ngAnnotate(CFG.ngAnnotate))
            .pipe(gulp.dest('./www/js'));
    }

})(require('gulp'));