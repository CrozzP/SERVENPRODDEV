const mix = require('laravel-mix');

//let mix = require('laravel-mix');


//mix.js('src/app.js', 'dist').setPublicPath('dist');

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

//mix.override((config) => {
//    delete config.watchOptions;
//});

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css');

//mix.js('resources/js/app.js', 'public/js').vue();
//mix.js('src/app.js', 'dist');
//
//mix.webpackConfig({
//    watchOptions: { ignored: /node_modules/ }
//});