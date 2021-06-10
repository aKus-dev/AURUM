const { src, dest, watch , parallel } = require('gulp');
const sass = require('gulp-sass');

const paths = {
    scss: 'src/scss/app.scss',
    all: 'src/scss/**/*.scss',
    admin: 'Administrador/sass/**/*.scss'

}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sass())
        .pipe( dest('./build/css') )
}

function watchArchivos() {
    watch(paths.all, css );
    watch(paths.admin, css );
}
  
// Prepara las funciones para cuando use el comando de gulp se ejecuten
exports.default = parallel(css, watchArchivos); 