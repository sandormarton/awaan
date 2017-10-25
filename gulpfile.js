/*var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/*elixir(function(mix) {
    mix.sass('app.scss');
});*/

/**
 * Created by Mohammed on 3/15/2017.
 */
var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');

var jsFiles = 'assets/scripts/**/*.js',
    jsDest = 'public/js';

gulp.task('scripts-frag1', function() {
    return gulp.src([
        "public/js/goto.js",
        "public/js/bootstrap.min.js",
        "public/js/pace/pace.min.js",
        "public/js/jquery.mmenu.all.min.js",
        "public/js/jquery.nicescroll.js",
        "public/js/jquery.fitvids.js",
        "public/js/jquery.bxslider.min.js",
        "public/js/jquery.flexslider-min.js",
        "public/js/jquery.mCustomScrollbar.concat.min.js",
        "public/js/owl.carousel.min.js",
        "public/js/jquery.sidebar.min.js",
        "public/js/jquery.selectric.min.js",
        "public/js/jquery.bpopup.min.js",
        "public/js/jquery.unveil-lazyload.js",
        "public/js/jquery-ajax/jquery-ajax-localstorage-cache.js",
        "public/js/rating/jquery.rateyo.min.js"
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

gulp.task('scripts-frag2', function() {
    return gulp.src([
        "public/js/jquery.bpopup.min.js",
        "public/js/jquery.cookie.js",
        "public/js/eModal.min.js",
        "public/js/ilightbox/js/ilightbox.js",
        "public/js/validator.js",
        "public/js/template.js",
        "public/js/main.js",
        "public/js/premium.js",
        "public/js/login.js"
    ])
        .pipe(concat('_scripts1.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('_scripts1.min.js'))
        .pipe(uglify({
            mangle: false,
            compress: false
        }))
        .pipe(gulp.dest(jsDest));
});

gulp.task('home-scripts', function() {
    return gulp.src([
        /*"public/js/handlebars.js/handlebars.min-latest.js",*/
        "public/js/handlebars.js/loadTemplate.js",
        "public/js/helpers.js",
        "public/js/home.js"
    ])
        .pipe(concat('_home.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('_home.min.js'))
        .pipe(uglify({
            mangle: false
        }))
        .pipe(gulp.dest(jsDest));
});

gulp.task('styles', function() {
    return gulp.src([
        "public/css/bootstrap.min.css",
        "public/css/bootstrap-theme.min.css",
        "public/css/jquery.mmenu.all.css",
        "public/css/ionicons.min.css",
        "public/css/animate.min.css",
        "public/css/jquery.mCustomScrollbar.css",
        "public/css/owl.carousel.css",
        "public/css/selectric.css",
        "public/css/flexslider.css",
        "public/css/template.css",
        "public/css/template_en.css",
        //"public/css/main.css",
        "public/js/pace/pace.css",
        //"public/css/loader.css",
        "public/js/rating/jquery.rateyo.min.css",
        "public/js/ilightbox/css/ilightbox.css"
    ])
        .pipe(concat('_styles.min.css'))
        .pipe(minify())
        .pipe(gulp.dest('public/css/'));
});

gulp.task('rtl-styles', function() {
    return gulp.src([
        "public/css/bootstrap.min.css",
        "public/css/bootstrap-rtl.min.css",
        "public/css/bootstrap-theme.min.css",
        "public/css/jquery.mmenu.all.css",
        "public/css/ionicons.min.css",
        "public/css/animate.min.css",
        "public/css/jquery.mCustomScrollbar.css",
        "public/css/owl.carousel.css",
        "public/css/selectric.css",
        "public/css/flexslider.css",
        "public/css/template.css",
        //"public/css/main.css",
        "public/js/pace/pace.css",
        //"public/css/loader.css",
        "public/js/rating/jquery.rateyo.min.css",
        "public/js/ilightbox/css/ilightbox.css"
    ])
        .pipe(concat('_styles-rtl.min.css'))
        .pipe(minify())
        .pipe(gulp.dest('public/css/'));
});