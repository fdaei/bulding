const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.css('resources/asset/operator/css/main.css','public/asset/operator/css')
    .js('resources/asset/operator/js/main.js','public/asset/operator/js');

mix.js("resources/asset/web/js/main.js" , 'public/asset/web/js')
    .css('resources/asset/web/css/main.css' , 'public/asset/web/css')


