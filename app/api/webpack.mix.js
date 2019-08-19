const mix = require('laravel-mix');
const path = require('path');

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

if (process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}

mix.ts('resources/assets/ts/main.ts', 'public/js')
    .sass('resources/assets/ts/sass/application.scss', 'public/css');
    // .webpackConfig({
    //     output: {
    //         publicPath: 'http://0.0.0.0:8089',
    //     },
    //     devServer: {
    //         contentBase: path.resolve(__dirname, 'public'),
    //         publicPath: '/',
    //         host: '0.0.0.0',
    //         port: 8089,
    //         proxy: {
    //             '/': {
    //                 target: 'http://nginx'
    //             }
    //         }
    //     },
    //     watchOptions: {
    //         poll: 2000,
    //         ignored: /node_modules/
    //     },
    // });
