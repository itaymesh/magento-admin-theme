var gulp = require('gulp');

var less      = require('gulp-less');
var minifycss = require('gulp-minify-css');
var util    = require('gulp-util');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var notify     = require('gulp-notify');
var clean      = require('gulp-clean');
var livereload = require('gulp-livereload');
var lr         = require('tiny-lr');
var server     = lr();
var rename     = require('gulp-rename');
var cssflip =        require('gulp-css-flip');

gulp.task('less', function() {
    gulp.src('less/app.less')
        .pipe(less()).on('error', function(e){
            util.log(e);
        })
        //.pipe(minifycss())
        .pipe(gulp.dest('dist'))
        .pipe(less()).on('error', function(e){
            util.log(e);
        })
        .pipe(rename({suffix: '-rtl'}))
        .pipe(cssflip.gulp())
        .pipe(gulp.dest('dist'))
        .pipe(livereload(server))
        .pipe(notify({
            message: 'Successfully compiled LESS'
    }));
});

// Watch
gulp.task('watch', function() {
    // Listen on port 35729
    server.listen(35729, function (err) {
        if (err) {
            return console.log(err);
        }

        gulp.watch('src/img/**/*', ['img']);

        // Watch .less files
        gulp.watch('src/less/**/*.less', ['less']);

        // Watch .js files
        gulp.watch('src/js/**/*.js', ['lint', 'js']);
    });
});