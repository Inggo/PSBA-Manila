let mix = require('laravel-mix');

mix.js('src/js/script.js', '.')
    .sass('src/scss/style.scss', '.')
    .options({processCssUrls: false});
