var elixir = require('laravel-elixir');

var styles_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Stylesheets
     |--------------------------------------------------------------------------
     */
    './bower_components/bootstrap/less',
    './bower_components/bootstrap-material-design/less',
    './bower_components/admin-lte/build/less',

    /*
     |--------------------------------------------------------------------------
     | Module Stylesheets
     |--------------------------------------------------------------------------
     */
    './modules/Forum/Resources/assets/less',
    './modules/Site/Resources/assets/less',
    './modules/User/Resources/assets/less',
];

var scripts_include = [
    /*
     |--------------------------------------------------------------------------
     | Vendor Javascript
     |--------------------------------------------------------------------------
     */
    './bower_components/jquery/dist/jquery.js',
    './bower_components/bootstrap/dist/js/bootstrap.js',
    //'./bower_components/bootstrap-material-design/dist/js/ripples.js',
    //'./bower_components/bootstrap-material-design/dist/js/material.js',

    /*
     |--------------------------------------------------------------------------
     | Module Javascript
     |--------------------------------------------------------------------------
     */
    './modules/Forum/Resources/assets/js/*.js',
    './modules/Site/Resources/assets/js/*.js',
    './modules/User/Resources/assets/js/*.js',
    './resources/assets/js/*.js',
];

var scripts_admin_include = [
    './bower_components/admin-lte/dist/js/app.js'
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
    mix.less(['app.less', 'admin.less'], 'public/static/css', {
        paths: styles_include
    });

    // concat scripts
    mix.scripts(scripts_include, 'public/static/js/app.js', './');

    mix.scripts(scripts_admin_include, 'public/static/js/admin.js', './');

    // copy fonts
    mix.copy('./bower_components/bootstrap/dist/fonts', 'public/static/fonts');
    //mix.copy('./bower_components/bootstrap-material-design/dist/fonts', 'public/static/fonts');

    // copy admin statics
    mix.copy('./bower_components/admin-lte/plugins', 'public/static/plugins');

    // versioning files
    mix.version([
        'public/static/css/app.css',
        'public/static/css/admin.css',
        'public/static/js/app.js',
        'public/static/js/admin.js']);
});