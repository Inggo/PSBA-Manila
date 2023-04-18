let mix = require('laravel-mix');

mix.js('src/js/script.js', '.')
    .js('src/js/events-calendar.js', '.')
    .sass('src/scss/style.scss', '.').options({
        processCssUrls: false
    });

mix.copy('./wp-content/plugins/cmb2', './vendor/cmb2/cmb2');

if (mix.inProduction()) {
    mix.copy('./*.php', './dist')
        .copy('./style.css', './dist')
        .copy('./script.js', './dist')
        .copy('./events-calendar.js', './dist')
        .copy('./screenshot.png', './dist')
        .copy('./images/', './dist/images')
        .copy('./wp/', './dist/wp')
        .copy('./vendor/', './dist/vendor')
        .copy('./partials/', './dist/partials')
        .copy('./templates/', './dist/templates')
        .copy('./*.md', './dist');
}
