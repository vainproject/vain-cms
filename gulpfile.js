process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

var scripts_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Javascript
     |--------------------------------------------------------------------------
     */
    './node_modules/jquery/dist/jquery.js',
    './node_modules/bootstrap/dist/js/bootstrap.js',
    './node_modules/toastr/toastr.js',
    './node_modules/jquery-treegrid/js/jquery.treegrid.js',
    './node_modules/jquery-treegrid/js/jquery.treegrid.bootstrap3.js',
    './node_modules/bootstrap-select/dist/js/bootstrap-select.js',
    './node_modules/wowjs/dist/wow.js',

    /*
     |--------------------------------------------------------------------------
     | App Javascript
     |--------------------------------------------------------------------------
     */
    './resources/assets/js/app.js',
    './resources/assets/js/modal.js',
    './resources/assets/js/notify.js',
    './resources/assets/js/pjax.js',
    './resources/assets/js/hero.js',
    './resources/assets/js/parallax.js',
    './resources/assets/js/core.js',
    './resources/assets/js/frontend.js',

    /*
     |--------------------------------------------------------------------------
     | Module Javascript
     |--------------------------------------------------------------------------
     */
    //'./modules/Forum/Resources/assets/js/*.js',
    //'./modules/Site/Resources/assets/js/*.js',
    //'./modules/User/Resources/assets/js/*.js',
];

var scripts_admin_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Javascript
     |--------------------------------------------------------------------------
     */
    './node_modules/admin-lte/dist/js/app.js',
    './resources/assets/js/search.js'

    /*
     |--------------------------------------------------------------------------
     | Module Javascript
     |--------------------------------------------------------------------------
     */
    //'./modules/User/Resources/assets/js/admin/*.js',
];

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

elixir(function(mix) {

    // compile less
    mix.less(['app.less', 'backend.less'], 'public/static/css/backend.css');
    mix.less(['app.less', 'frontend.less'], 'public/static/css/frontend.css');

    // register custom watcher for less task
    elixir.Task.find('less').watchers.push('./modules/**/*.less');

    // concat scripts
    mix.scripts(scripts_include, 'public/static/js/app.js', './');
    mix.scripts(scripts_admin_include, 'public/static/js/admin.js', './');
    // NOTE: watcher for every given script are added automatically

    // copy fonts
    mix.copy('./node_modules/bootstrap/dist/fonts', 'public/static/fonts');
    mix.copy('./node_modules/font-awesome/fonts', 'public/static/fonts');
    mix.copy('./resources/assets/fonts', 'public/static/fonts');

    // copy images
    mix.copy('./resources/assets/img', 'public/static/images');

    // copy admin statics
    //mix.copy('./node_modules/admin-lte/plugins', 'public/static/plugins');

    // versioning files
    //mix.version([
    //    'public/static/css/app.css',
    //    'public/static/css/admin.css',
    //    'public/static/js/app.js',
    //    'public/static/js/admin.js']);
});
