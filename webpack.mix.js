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

mix
    .js('resources/assets-src/js/ray.js', 'resources/assets/js')
    .sass('resources/assets-src/sass/ray.scss', 'resources/assets/css')
    .copyDirectory('resources/assets-src/img', 'resources/assets/img');
