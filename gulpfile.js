var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('activeTripOrganiser.js');
    mix.scripts(['form.js','iban.js','dropswitch.js','jquery-3.3.1.js']);
});
