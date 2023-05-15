let mix = require('laravel-mix');

mix.js('src/js/script.js', '.')
    .sass('src/scss/style.scss', '.').options({
        processCssUrls: false
    })
    .sass('src/scss/admin.scss', '.').options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.copy('./wp-content/plugins/cmb2', './vendor/cmb2/cmb2');

    mix.copy('./*.php', './dist')
        .copy('./admin.css', './dist')
        .copy('./style.css', './dist')
        .copy('./script.js', './dist')
        .copy('./screenshot.png', './dist')
        .copy('./images/', './dist/images')
        .copy('./wp/', './dist/wp')
        .copy('./vendor/', './dist/vendor')
        .copy('./partials/', './dist/partials')
        .copy('./templates/', './dist/templates')
        .copy('./*.md', './dist');
}
