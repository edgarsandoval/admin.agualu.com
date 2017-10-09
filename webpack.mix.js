const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.sass('resources/assets/sass/patch.scss', 'public/css')
    .styles([
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
        'node_modules/toastr/build/toastr.min.css',
    ], 'public/css/vendor.css');

 mix.scripts([
     'node_modules/lscache/lscache.min.js',
     'node_modules/sweetalert2/dist/sweetalert2.min.js',
     'node_modules/toastr/build/toastr.min.js'
 ], 'public/js/vendor.js');
