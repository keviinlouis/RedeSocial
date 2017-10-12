let mix = require('laravel-mix');

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

mix.js(['resources/assets/js/app.js', 'resources/assets/js/dashboard.js'], 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .styles(['resouncers/assets/css/material-dashboard.css'], 'public/css/all.css');