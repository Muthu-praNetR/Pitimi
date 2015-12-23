var elixir = require('laravel-elixir');

elixir(function (mix) {
    mix.sass('app.scss');
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js'
    ], 'public/js/vendors.js');
    mix.browserSync({
        proxy: 'localhost:8000'
    });
    //mix.phpUnit();
});
