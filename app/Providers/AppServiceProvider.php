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

        Validator::extend('uniqueEmailAndExtension', function ($attribute, $value, $parameters, $validator) {
            $sFullEmail = $value . '@' . $parameters[0]; //$value should be first part of the email, $parameters[0] should be the extension;
            $count = Traveller::where('email', $sFullEmail)->count();
            return $count === 0;    //if false, throw error
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
