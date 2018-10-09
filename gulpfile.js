var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
});
elixir(function(mix) {
    mix.scripts([
        'form.js'
    ]);
});