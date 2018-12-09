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
        Validator::extend('uniqueEmailAndExtension', function ($attribute, $value, $parameters, $validator) {
            $sFullEmail = $value . '@' . $parameters[0];                    //$value should be first part of the email, $parameters[0] should be the extension;
            $count = Traveller::where('email', $sFullEmail)->count();
            return $count === 0;    //if false, throw error
            //return false;
        });
        Validator::replacer('uniqueEmailAndExtension', function ($message, $attribute, $rule, $parameters) {
            return 'Deze email is al in gebruik. Als je denkt dat dit niet kan, vraag om hulp op de contactpagina door een email te sturen.';
        });

        Schema::defaultStringLength(191);
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new ValidatorExtension($translator, $data, $rules, $messages, []);
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
