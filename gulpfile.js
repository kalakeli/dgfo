var gulp = require('gulp'),
  concat = require('gulp-concat'),
  plumber = require('gulp-plumber'),
  rename = require('gulp-rename'),
  compress = require('gulp-minify'),
  minify = require('gulp-clean-css');

// task to combine the various css files to one, minify, and safe
gulp.task('css', function() {
  gulp.src('src/styles/*.css')
      .pipe(concat('styles.css'))
      .pipe(minify())
      .pipe(rename('styles.min.css'))
      .pipe(gulp.dest('dist/css/'));
});

// task to compress the js files
gulp.task('compress', function() {
  gulp.src('src/js/*.js')
    .pipe(plumber())
    .pipe(compress({
        ext:{
            src:'-debug.js',
            min:'.js'
        }
    }))
    .pipe(gulp.dest('dist/js/'))
});

// as with my new Mac OS imagemagick and graphicsmagick seem not to work,
// I am trying this here and it works just fine
// step 1 - npm install sharp
// step 2 - npm install --save-dev gulp-responsive
// step 3 - npm install --save-dev gulp-load-plugins (am not sure I need it)
// https://github.com/mahnunchik/gulp-responsive/blob/master/examples/srcset.md
var $ = require('gulp-load-plugins')();
gulp.task('images', function () {
return gulp.src('src/images/*.{jpg,JPG,png}')
  .pipe($.plumber())
  .pipe($.responsive({
    // Convert all images to JPEG format
    '*': [{
      // image-medium.jpg is 400 pixels wide
      width: 100,
      quality: 70,
      rename: {
        suffix: '_th',
        extname: '.jpg',
      },
    },{
      // image-medium.jpg is 400 pixels wide
      width: 200,
      quality: 70,
      rename: {
        suffix: '_sm',
        extname: '.jpg',
      },
    }, {
      // image-medium.jpg is 400 pixels wide
      width: 400,
      quality: 70,
      rename: {
        suffix: '_mi',
        extname: '.jpg',
      },
    }, {
      // image-large.jpg is 768 pixels wide
      width: 600,
      quality: 70,
      rename: {
        suffix: '_lg',
        extname: '.jpg',
      },
    }, {
      // image-extralarge.jpg is 990 pixels wide
      width: 800  ,
      quality: 70,
      rename: {
        suffix: '_xl',
        extname: '.jpg',
      },
    }],
  }))
  .pipe(gulp.dest('dist/images/'));
});

// keep an eye on changes in the styles folder
gulp.task('watch', function(){
  gulp.watch('src/styles/*.css', ['css']);
  gulp.watch('src/js/*.js', ['compress']);
});

gulp.task('default', ['css', 'compress', 'images', 'watch']);
