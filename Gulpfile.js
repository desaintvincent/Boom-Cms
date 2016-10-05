//dependencies
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var notify = require("gulp-notify");

//paths
var sass_site_files = 'Static/src/sass/site.scss';
var css_site_dest = './Static/dist/css/';

var sass_admin_files = 'Apps/Admin/Static/sass/admin.scss';
var css_admin_dest = './Apps/Admin/Static/dist/css/';

var js_site_files = ['Static/src/js/libs/jquery.min.js','Static/src/js/libs/*.js', 'Static/src/js/site.js'];
var js_site_dest = 'Static/dist/js';

var js_admin_files = ['Static/src/js/libs/jquery.min.js','Static/src/js/libs/bootstrap.min.js', './Apps/Admin/Static/js/libs/*.js', './Apps/Admin/Static/js/admin.js'];
var js_admin_dest = 'Apps/Admin/Static/dist/js';


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
    gulp.watch(['Static/src/sass/components/*.scss', 'Static/src/sass/site.scss'],['sass_site']);
    //sase admin
    gulp.watch(['Apps/Admin/Static/sass/components/*.scss', 'Apps/Admin/Static/sass/admin.scss'],['sass_admin']);
    //js site
    gulp.watch(['Static/src/js/libs/*.js', 'Static/src/js/site.js'],['uglify_site']);
    //js admin
    gulp.watch(['Apps/Admin/Static/js/libs/*.js', 'Apps/Admin/Static/js/admin.js'],['uglify_admin']);
});