/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    let exec   = require('child_process').exec,
        rename = require('gulp-rename');

    // Copy all html files to the `./www/templates` folder.
    gulp.task('templates', templates);
    function templates() {
        exec('rm -rf ./www/templates', _ => {
            gulp
                .src([
                    './src/**/*.view.html'
                ])
                // .pipe(rename({ dirname: '' })) // Remove foldernames from path.
                .pipe(gulp.dest('./www/templates'));
        }); // Delete folder and all files within.

    }

})(require('gulp'));