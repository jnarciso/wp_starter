
const syntax        = 'sass';
const srcDir 		= './includes/';
const destDir 		= './includes/';

const gulp        					= require('gulp'),
	sass          					= require('gulp-sass'),
	sourcemaps 						= require('gulp-sourcemaps');
	concat        					= require('gulp-concat'),
	uglify        					= require('gulp-uglify-es').default,
	cleancss      					= require('gulp-clean-css'),
	rename        					= require('gulp-rename'),
	autoprefixer  					= require('gulp-autoprefixer'),	
	notify        					= require('gulp-notify'),
	imagemin      					= require('gulp-imagemin'),
	imageminJpegRecompress 			= require('imagemin-jpeg-recompress'),
	realFavicon 					= require('gulp-real-favicon'),

	sass.compiler 					= require('node-sass');

var faviconDataFile					= 'faviconData.json'; // setup variable for favicon markup file

function styles(){
	return gulp.src([
		srcDir + syntax + '/styles.scss',
	])
	.pipe(sourcemaps.init())
	.pipe(sass({ outputStyle: 'compressed' }).on("error", notify.onError()))
	.pipe(concat('styles.min.css'))
	.pipe(rename({ suffix: '', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	//.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest(destDir + 'css'));
}

function vendorScripts(){
	return gulp.src([
		srcDir + 'js/vendor/*', 
	])
	.pipe(concat('vendors.min.js'))
	.pipe(uglify()) 
	.pipe(gulp.dest(destDir + 'js'));
}

function customScripts(){
	return gulp.src([
		srcDir + 'js/custom/*', 
	])
	.pipe(concat('custom.min.js'))
	.pipe(uglify()) 
	.pipe(gulp.dest(destDir + 'js'));
}

function reload(done){
	browserSync.reload();
	return done();
}

function images(){
	return gulp.src('./includes/images/raw/*')
	.pipe(imagemin([
		imageminJpegRecompress({
        progressive: true,
        max: 60,
        min: 40
     })
	]))
	.pipe(gulp.dest('./includes/images'));
}

// individual Gulp task to generate project favicons
// requires source file below defined as masterPicture
// just run 'generate-favicon' from project root once favicon image is updated
gulp.task('generate-favicon', function(done) {
	realFavicon.generateFavicon({
		masterPicture: './includes/images/favicon.png',
		dest: './includes/images/device-icons',
		iconsPath: '/',
		design: {
			ios: {
				pictureAspect: 'noChange',
				assets: {
					ios6AndPriorIcons: false,
					ios7AndLaterIcons: false,
					precomposedIcons: false,
					declareOnlyDefaultIcon: true
				}
			},
			desktopBrowser: {
				design: 'raw'
			},
			windows: {
				pictureAspect: 'noChange',
				backgroundColor: '#da532c',
				onConflict: 'override',
				assets: {
					windows80Ie10Tile: false,
					windows10Ie11EdgeTiles: {
						small: false,
						medium: true,
						big: false,
						rectangle: false
					}
				}
			},
			androidChrome: {
				pictureAspect: 'noChange',
				themeColor: '#ffffff',
				manifest: {
					display: 'standalone',
					orientation: 'notSet',
					onConflict: 'override',
					declared: true
				},
				assets: {
					legacyIcon: false,
					lowResolutionIcons: false
				}
			},
			safariPinnedTab: {
				pictureAspect: 'silhouette',
				themeColor: '#5bbad5'
			}
		},
		settings: {
			scalingAlgorithm: 'Mitchell',
			errorOnImageTooSmall: false,
			readmeFile: false,
			htmlCodeFile: false,
			usePathAsIs: false
		},
		markupFile: faviconDataFile,
	}, function() {
		done();
	});
});


function watcher(){
	gulp.watch(srcDir + syntax + '/**/*', gulp.parallel(styles));
	gulp.watch(['includes/js/vendor/*.js'], gulp.parallel(vendorScripts));
	gulp.watch(['includes/js/custom/*.js'], gulp.parallel(customScripts));
}

exports.styles = gulp.parallel(styles);
exports.scripts = gulp.parallel(vendorScripts);
exports.scripts = gulp.parallel(customScripts);
exports.images = gulp.parallel(images);
exports.default = gulp.parallel(styles, vendorScripts, customScripts, images, watcher);


