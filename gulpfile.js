// ディレクトリ指定
var path = {
  'themePath': 'wp/wp-content/themes/boyaki-channel',
}

// gulpプラグイン読み込み
var gulp = require("gulp");
var compass = require('gulp-compass');//Sass Compile
var plumber = require('gulp-plumber');//コンパイルエラーが出てもwatchを止めない
var imagemin = require("gulp-imagemin");//Image Optimization


// Sass Compile
gulp.task('compass', function(){
    gulp.src(path.themePath + '/_src/*.scss')
    .pipe(plumber())
    .pipe(compass({
        config_file: 'config.rb',
        comments: false,
        css: path.themePath + '/css/',
        sass: path.themePath + '/_src/sass'
    }))
    .pipe(csscomb())
    .pipe(autoprefixer())
    .pipe(cleancss())
    .pipe(gulp.dest('dist'));
});


// ファイル変更監視
gulp.task('watch', function(){
  gulp.watch(path.themePath + '/_src/sass/**/*.scss',['compass']);
});

gulp.task('default', ['watch']);


// Image Optimization
gulp.task('imagemin', function(){// 「imageMinTask」という名前のタスクを登録
  gulp.src(path.themePath + '/_src/images/**/*')// imagesフォルダ以下の画像を取得
    .pipe(imagemin())//画像の圧縮処理を実行
    .pipe(gulp.dest(path.themePath + '/images'))// 指定フォルダーに保存
});
