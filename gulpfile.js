const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir.config.publicPath = './public';

elixir((mix) => {
    mix
        .sass(['app.scss'], './public/css/main.css')
        .webpack('app.js', './public/js/app.js')
        .version([
            './public/css/main.css', 
            './public/js/app.js'
        ])
        .copy('./node_modules/bootstrap-sass/assets/fonts', 'public/build/fonts');
});