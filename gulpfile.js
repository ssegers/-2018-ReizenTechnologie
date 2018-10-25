var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('jquery-3.3.1.min.js');
    mix.scripts('form.js');
    mix.scripts('activeTripOrganiser.js');
});
