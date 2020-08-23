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
  .js('resources/js/app.js', 'public/js/admin')
  .sass('resources/sass/app.scss', 'public/css/admin')
  .extract(['vue', 'bootstrap', 'jquery', 'lodash', 'axios', 'popper.js']);


mix.options({
  processCssUrls: false,
  extractVueStyles: false,
  purifyCss: false,
  clearConsole: false
});
