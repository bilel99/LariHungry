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

// Back
mix.js('resources/js/admin/app.js', 'public/admin/js')
    .sass('resources/sass/admin/app.scss', 'public/admin/css');

// Front
mix.js('resources/js/front/app.js', 'public/front/js')
    .sass('resources/sass/front/app.scss', 'public/front/css');

// BrowserSync Reloading
//mix.browserSync('localhost:8000');