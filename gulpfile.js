// Include gulp
var gulp = require('../node_modules/gulp');

// Include Our Plugins
var jshint = require('../node_modules/gulp-jshint');
var less = require('../node_modules/gulp-less');
var minifyCSS = require('../node_modules/gulp-minify-css');
var concat = require('../node_modules/gulp-concat');
var uglify = require('../node_modules/gulp-uglify');
var rename = require('../node_modules/gulp-rename');
var cleancss = require('../node_modules/gulp-clean-css');





 //Lint Task
 gulp.task('lint', function() {
     return gulp.src('resources/js/src/*.js')
         .pipe(jshint())
         .pipe(jshint.reporter('default'));
 });



// Compile Our less
gulp.task('less', function(callback) {
    return gulp.src([
        'resources/less/src/base.less',
        'resources/less/src/*.less'

        ])
        .pipe(concat('styles.less'))
        .pipe(less())
        .pipe(rename('styles.css'))
        .pipe(gulp.dest('resources/css/src'))
        callback(error);



});

// // Starts a BrowerSync instance
// gulp.task('server', ['build'], function(){
//   browser.init({server: './_site', port: port});
// });
// Instead of the list parameter they have introduced gulp.series() and gulp.parallel().

// This task should be changed to something like this:

// Starts a BrowerSync instance
gulp.task('css', gulp.series('less', function(){
  return gulp.src([
         'resources/css/lib/normalize.css',
         'resources/css/lib/bootstrap.min.css',
         'resources/css/src/*.css'

        ]
        )
        .pipe(concat('styles.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('public/assets'))
}));
// Minify CSS
// gulp.task('css', ['less'],  function() {
//     return gulp.src([
//         'resources/css/lib/normalize.css',
//         'resources/css/lib/bootstrap.min.css',
//         'resources/css/src/main.css',
//         ]
//         )
//         .pipe(concat('styles.min.css'))
//         .pipe(minifyCSS())
//         .pipe(gulp.dest('assets/css'))
// });

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src([
         'resources/js/lib/modernizr-3.6.0.min.js',
         'resources/js/lib/jquery-3.3.1.min.js',
         'resources/js/lib/plugins.js',
         'resources/js/lib/bootstrap.min.js',         
         'resources/js/src/*.js'


        ])
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/assets'));
});



// Default Task
gulp.task('default', gulp.series('lint','less', 'css', 'scripts'));

// Watch Files For Changes
gulp.task('watch', function() {

    gulp.watch('resources/js/src/*.js', gulp.series('default'));
    gulp.watch('resources/less/src/*.less', gulp.series('default'));
});
