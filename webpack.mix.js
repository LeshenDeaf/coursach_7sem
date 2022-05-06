const mix = require('laravel-mix');
const tailwind = require('tailwindcss');
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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [ tailwind('./tailwind.config.js')]
    })
    .version();

mix.browserSync('127.0.0.1:8000');
//
// .postCss('resources/css/app.css', 'public/css', [
//         require("tailwindcss"),
//     ])
