<?php

namespace App\Providers;

use App\Traveller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Intervention\Validation\ValidatorExtension;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new ValidatorExtension($translator, $data, $rules, $messages, []);
        });

        /**
         * @author Joren Meynen
         * Combines the 2 fields for 'email' and 'extension'
         * and checks if it is unique in the database
         */
        Validator::extend('uniqueEmailAndExtension', function ($attribute, $value, $parameters, $validator) {
            $sFullEmail = $value . '@' . $parameters[0];                    //$value should be first part of the email, $parameters[0] should be the extension;
            $count = Traveller::where('email', $sFullEmail)->count();
            return $count === 0;    //if false, throw error
        });
        Validator::replacer('uniqueEmailAndExtension', function ($message, $attribute, $rule, $parameters) {
            return 'Deze email is al in gebruik. Als je denkt dat dit niet kan, vraag om hulp op de contactpagina door een email te sturen.';
        });

        /**
         * @author Joren Meynen
         * Combines the 2 fields for 'email' and 'extension'
         * and checks if it is a valid email format
         */
        Validator::extend('validEmail', function ($attribute, $value, $parameters, $validator) {
            $sFullEmail = $value . '@' . $parameters[0];                    //$value should be first part of the email, $parameters[0] should be the extension;
            if (filter_var($sFullEmail, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        });
        Validator::replacer('validEmail', function ($message, $attribute, $rule, $parameters) {
            return 'U heeft geen geldig email adres opgegeven';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
