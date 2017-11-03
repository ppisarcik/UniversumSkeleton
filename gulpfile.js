var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var pump = require('pump');
var cleanCSS = require('gulp-clean-css');


gulp.task('admin-sheets', function() {
    return gulp.src([
        './www/admin-module/plugins/fileuploader/src/jquery.fileuploader.css',
        './www/admin-module/plugins/fileuploader/src/jquery.fileuploader-theme-dragdrop.css',
        './node_modules/trumbowyg/dist/ui/trumbowyg.min.css',
        './www/admin-module/plugins/happy/dist/happy.min.css',
        './node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
        './vendor/ublaboo/datagrid/assets/dist/datagrid.min.css',
        './vendor/ublaboo/datagrid/assets/dist/datagrid-spinners.min.css',
        './www/admin-module/stylesheet/style.css'
    ])
        .pipe(concat('main.css'))
        .pipe(gulp.dest('./www/admin-module/stylesheet/'));
});

gulp.task('minify-css', ['admin-sheets'], function() {
    return gulp.src('./www/admin-module/stylesheet/main.css')
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./www/admin-module/stylesheet/'));
});

gulp.task('admin-scripts', function() {
    return gulp.src([
        './www/admin-module/plugins/fileuploader/src/jquery.fileuploader.min.js',
        './node_modules/trumbowyg/dist/trumbowyg.min.js',
        './vendor/nette/forms/src/assets/netteForms.min.js',
        './www/admin-module/plugins/happy/dist/happy.min.js',
        './node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        './node_modules/sortablejs/Sortable.min.js',
        './vendor/ublaboo/datagrid/assets/dist/datagrid.min.js',
        './vendor/ublaboo/datagrid/assets/dist/datagrid-instant-url-refresh.min.js',
        './vendor/ublaboo/datagrid/assets/dist/datagrid-spinners.js',
        './www/admin-module/js/custom.js'
        ])
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./www/admin-module/js/'));
});

gulp.task('minify-js', ['admin-scripts'], function (cb) {
    pump([
            gulp.src('./www/admin-module/js/main.js'),
            uglify(),
            gulp.dest('./www/admin-module/js/')
        ],
        cb
    );
});

gulp.task('watch', function() {
    gulp.watch('./www/admin-module/stylesheet/style.css', ['minify-css']);
    gulp.watch('./www/admin-module/js/custom.js', ['minify-js']);
});


gulp.task('sheets', function() {
    return gulp.src([
        './www/stylesheet/vendor/lightslider.css',
        './www/stylesheet/vendor/owl.carousel.css',
        './www/stylesheet/vendor/owl.theme.default.css',
        './www/stylesheet/reset.css',
        './www/stylesheet/style.css'
    ])
        .pipe(concat('main.css'))
        .pipe(gulp.dest('./www/stylesheet/'));
});

gulp.task('scripts', function() {
    return gulp.src([
        './node_modules/lightslider/dist/js/lightslider.js',
        './node_modules/owl.carousel/dist/owl.carousel.js',
        './www/js/maps.js',
        './www/js/custom.js',
    ])
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./www/js/'));
});