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

/* Theme Files
mix.styles([
    'resources/css/theme.css',
    'resources/css/bootstrap.min.css'
], 'public/theme/css/theme.css');

mix.js([
    'resources/js/jquery-3.2.1.min.js',
    'resources/js/bootstrap.js'
], 'public/theme/js/theme.js');

mix.copyDirectory('resources/fonts', 'public/theme/fonts');
*/
mix.browserSync('localhost:8000');

