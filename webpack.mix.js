const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/style.scss', 'public/css/backend')
    .styles([
        'public/css/global/bootstrap.min.css',
        'public/font-awesome/css/font-awesome.css',
        'public/css/global/animate.css',
        'public/css/global/blueimp/css/blueimp-gallery.min.css',

    ], 'public/css/backend/all.css')
    .combine(['resources/js/backend/*'], 'public/js/backend/all.js');

// mix.browserSync("http://localhost:8000");
