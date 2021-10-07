const { series, src, dest, watch, parallel } = require('gulp');
const sass = require('gulp-sass');
const imagemin  = require('gulp-imagemin');
const notify = require('gulp-notify');
const webp = require('gulp-webp');
const concat = require('gulp-concat');

//___Funcion que compila sass____
const paths = {
    imagenes: 'src/img/**/*',
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
}

function css(  ) {
    return src (paths.scss)
        .pipe( sass({ 
            outputStyle: 'expanded'
        }))
        .pipe( dest('./build/css') )
}

function mini(  ) {
    return src (paths.scss)
        .pipe( sass( {
            outputStyle:'compressed'
        } ))
        .pipe( dest('./build/css') )
}

function imagenes() {
    return src(paths.imagenes)
        .pipe( imagemin() )
        .pipe( dest( './build/img' ))
        .pipe( notify({message:'Imagen minificada'}) ); 
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() ) 
        .pipe( dest ('./build/img'))
        .pipe( notify({message: 'Version WEBP lista'}));
}
function javascript() {
    return src(paths.js)
       .pipe( concat('bundle.js'))
        .pipe( dest('./build/js'))
}
function watchArchivos() {
    watch(paths.scss, css) //*=carpeta actual - **=todos los archivos 
    watch(paths.js, javascript);
}

exports.css = css; 
// exports.mini = mini; 
exports.imagenes = imagenes;
exports.watchArchivos = watchArchivos;
exports.versionWebp = versionWebp;
exports.default = series( css, javascript, imagenes, versionWebp, watchArchivos);


