/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
((gulp, gutil) => {
    'use strict';

    gulp.task('build', ['scripts', 'templates'], build);

    function build() {
        gutil.log(gutil.colors.white.bgBlue.bold(' App built. '));
    }

})(require('gulp'), require('gulp-util'));