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
    .sass('resources/sass/app.scss', 'public/css');


    mix.styles([
        'resources/assets/css/material-dashboard.css',
        'resources/assets/css/bootstrap-select.min.css',
        'resources/assets/css/bootstrap-select.css.map',
        'resources/assets/css/bootstrap-select.css',
        
        
        ], 'public/css/all.css');

        