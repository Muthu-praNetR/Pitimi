var elixir = require('laravel-elixir');

elixir(function (mix) {
    mix.sass('app.scss');
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/angular/angular.js',
        '../../../node_modules/lodash/index.js'
    ], 'public/js/vendors.js');
    mix.browserSync({
        proxy: 'localhost:8000'
    });
    //mix.phpUnit();
});
