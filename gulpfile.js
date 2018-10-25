var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('form.js');
    mix.scripts('jquery-3.3.1.js');
    mix.scripts(['form.js','iban.js']);
});
