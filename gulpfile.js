process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    require('vain')(mix, {
        'extra_less': [
            './resources/assets/less/modules.less'
        ]
    });

    // versioning files
    //mix.version([
    //    'public/static/css/app.css',
    //    'public/static/css/admin.css',
    //    'public/static/js/app.js',
    //    'public/static/js/admin.js']);
});
