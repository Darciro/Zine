'use strict';

var gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	jshint 		= require('gulp-jshint'),
	concat 		= require('gulp-concat'),
	uglify 		= require('gulp-uglify'),
	imagemin 	= require('gulp-imagemin'),
	plumber 	= require('gulp-plumber'),
	notify 		= require('gulp-notify'),
	livereload 	= require('gulp-livereload'),
	deploy 		= require('gulp-deploy-git');

gulp.task('default', function () {
	console.log('default gulp task...')
});

gulp.task('sass', function () {
	return gulp.src('./assets/css/sass/**/*.scss')
			.pipe(plumber(plumberErrorHandler))
			.pipe(sass({outputStyle: 'compressed'}))
			.pipe(gulp.dest('./assets/css'))
			.pipe(livereload());
});

gulp.task('js', function () {
	gulp.src('./assets/js/src/*.js')
			.pipe(plumber(plumberErrorHandler))
			.pipe(jshint())
			.pipe(jshint.reporter('default'))
			.pipe(concat('theme.js'))
			.pipe(uglify())
			.pipe(gulp.dest('./assets/js/dist/'))
			.pipe(livereload());
});

// Uglify with gulp-uglify
gulp.task('compress', function () {
	return gulp.src('./assets/js/dist/*.js')
			.pipe(uglify())
			.pipe(gulp.dest('./assets/js/dist/'));
});

gulp.task('img', function() {
	gulp.src('./assets/img/src/*.{png,jpg,gif}')
		.pipe(plumber(plumberErrorHandler))
		.pipe(imagemin({
			optimizationLevel: 7,
			progressive: true
		}))
		.pipe(gulp.dest('./assets/img/dist/'))
		.pipe(livereload());
});

gulp.task('watch', function() {
	livereload.listen();
	gulp.watch('./assets/css/sass/**/*.scss', ['sass']);
	gulp.watch('./assets/js/src/*.js', ['js']);
	gulp.watch('./assets/img/*.{png,jpg,gif}', ['img']);
});

var plumberErrorHandler = { errorHandler: notify.onError({
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	})
};

gulp.task('deploy', function() {
	return gulp.src('../../../../')
		.pipe(deploy({
			repository: 'https://github.com/Darciro/Zine.git'
		}));
});

gulp.task('default', ['sass', 'js', 'img', 'watch']);