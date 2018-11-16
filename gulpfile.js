var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('activeTripOrganiser.js');
    mix.scripts('cascadingDropdownMajorStudies.js');
    mix.scripts(['form.js','iban.js']);
    mix.scripts(['dropswitch.js']);
    mix.scripts(['jquery-3.3.1.js']);
});
