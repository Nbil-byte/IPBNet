const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .autoload({
        jquery: ['$', 'window.jQuery']
    });

if (mix.inProduction()) {
    mix.version();
}
