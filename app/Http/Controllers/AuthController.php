<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthController extends controller
{
    public function index()
    {
        return view('home');
    }
    public function login(Request $request)
    {
        try
        {
            $user = User::where(['username'=> request('username'), 'password' => request('password')])->get();
            if (! auth()->attempt(request(['username', 'password'])))
            {
                if (! auth()->loginUsingId($user->user_id))
                {
                    return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
                }
            }
            if (Auth::user()) {
                $role = Auth::user()->role;
                if ($role == "admin"){
                    return redirect('/admin');
                }
                if ($role == "guest"){
                    return redirect('/user/form/step-0');
                }
                return redirect('/info');
            }
        }
        catch (\Exception $e) {
            return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
        }
    }

    public function logout(){

        Auth::logout();
        return redirect('/info');
    }

    public function showView(){
        return view("auth.Authenticate");
    }
}
