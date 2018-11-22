var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts('activeTripOrganiser.js');
    mix.scripts('cascadingDropDownStudyMajors.js');
    mix.scripts(['form.js']);
    mix.scripts(['dropswitch.js']);
    mix.scripts(['jquery-3.3.1.js']);
});
