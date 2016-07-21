var gulp = require('gulp');
var sass = sass = require('gulp-sass');

var paths = {
    sass: 'styles/**/*.scss'
};

gulp.task('default', ['sass']);

gulp.task('sass', function () {
    return gulp.src('styles/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('../../web/css'));
});

gulp.task('watch', function() {
    gulp.watch(paths.sass, ['sass']);
});

