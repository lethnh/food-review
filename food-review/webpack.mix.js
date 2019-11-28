const mix = require('laravel-mix');


mix.js('resources/backend/js/app.js', 'public/backend/js')
    .sass('resources/backend/sass/app.scss', 'public/backend/css')
    .options({
        processCssUrls: false
    }).version();

mix.js('resources/frontend/js/app.js', 'public/frontend/js')
    .js('resources/frontend/js/main.js', 'public/frontend/js')
    .sass('resources/frontend/sass/app.scss', 'public/frontend/css')
    .options({
        processCssUrls: false
    }).version();
