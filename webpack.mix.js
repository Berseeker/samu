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

// mix.js('resources/js/app.js', 'public/js').vue()
//     .sass('resources/sass/app.scss', 'public/css')
//     .webpackConfig(require('./webpack.config'));

// // Dashboard theme assets...
// mix.js('resources/js/dashboard.js', 'public/js')
//     .sass('resources/sass/dashboard/dashboard.scss', 'public/css');


mix.js('resources/js/main.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .webpackConfig(require('./webpack.config'));


if (mix.inProduction()) {
    mix.version();
}
