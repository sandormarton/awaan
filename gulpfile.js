var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');

var jsDest = 'public/js';

gulp.task('scripts-mini', function() {
    return gulp.src([
        "public/js/jquery.mCustomScrollbar.concat.min.js",
        "public/js/bootstrap.min.js",
        "public/js/loader.min.js",
        "public/js/owl.carousel.min.js",
        "public/js/jquery.maskedinput.min.js",
        "public/js/jquery.unveil.js",
        "public/js/jquery.lazy.min.js",
        "public/js/select2.full.min.js"
    ])
    .pipe(concat('_scripts.js'))
    .pipe(gulp.dest(jsDest))
    .pipe(rename('_scripts.min.js'))
    .pipe(uglify({
        mangle: false,
        compress: false
    }))
    .pipe(gulp.dest(jsDest));
});

gulp.task('styles', function() {
    return gulp.src([
        "public/css/bootstrap.min.css",
        "public/css/bootstrap-theme.min.css",
        "public/css/font-awesome.min.css",
        "public/css/mCustomScrollbar.min.css",
        "public/css/owl.carousel.min.css",
        "public/css/select2.min.css",
        "public/css/loader.css",
        "public/js/rating/jquery.rateyo.min.css",
        "public/css/colors.css"
    ])
        .pipe(concat('_styles.min.css'))
        .pipe(minify())
        .pipe(gulp.dest('public/css/'));
});
