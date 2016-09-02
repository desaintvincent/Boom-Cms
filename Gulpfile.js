//dependencies
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var notify = require("gulp-notify");

//paths
var sass_site_files = 'assets/src/sass/site.scss';
var css_site_dest = './assets/dist/css/';
var sass_admin_files = 'assets/src/sass/admin/admin.scss';
var css_admin_dest = './assets/dist/css/';
var js_site_files = ['assets/src/js/libs/*.js', 'assets/src/js/site.js'];
var js_site_dest = 'assets/dist/js';
var js_admin_files = ['assets/src/js/libs/*.js', 'assets/src/js/admin.js'];
var js_admin_dest = 'assets/dist/js';


//tasks
gulp.task('uglify_site', function() {
    gulp.src(js_site_files)
        .pipe(concat('site.js'))
        .pipe(gulp.dest(js_site_dest))
        .pipe(rename('site.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(js_site_dest))
        .pipe(notify("uglify site ok"));
});

gulp.task('uglify_admin', function() {
    gulp.src(js_admin_files)
        .pipe(concat('admin.js'))
        .pipe(gulp.dest(js_admin_dest))
        .pipe(rename('admin.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(js_admin_dest))
        .pipe(notify("uglify admin ok"));
});

gulp.task('sass_site', function() {
    gulp.src(sass_site_files)
        .pipe(sass({
            outputStyle: 'compressed',
            onError: function (err) {
                console.log(err);
                notify().write({
                    title: 'Gulp: Error SASS on site',
                    message: sass.logError
                });
            }
        }).on('error', sass.logError))
        .pipe(gulp.dest(css_site_dest))
        .pipe(notify("sass site ok"));
});

gulp.task('sass_admin', function() {
    gulp.src(sass_admin_files)
        .pipe(sass({
            outputStyle: 'compressed',
            onError: function (err) {
                console.log(err);
                notify().write({
                    title: 'Gulp: Error SASS on admin',
                    message: sass.logError
                });
            }
        }).on('error', sass.logError))
        .pipe(gulp.dest(css_admin_dest))
        .pipe(notify("sass admin ok"));
});

//Watch task
gulp.task('default',function() {
    //sass site
    gulp.watch(['assets/src/sass/components/*.scss', 'assets/src/sass/site.scss'],['sass_site']);
    //sase admin
    gulp.watch(['assets/src/sass/admin/components/*.scss', 'assets/src/sass/admin/admin.scss'],['sass_admin']);
    //js site
    gulp.watch(['assets/src/js/libs/*.js', 'assets/src/js/site.js'],['uglify_site']);
    //js site
    gulp.watch(['assets/src/js/libs/*.js', 'assets/src/js/admin/admin.js'],['uglify_admin']);
});