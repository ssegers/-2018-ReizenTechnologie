<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function store()
    {
        try
        {
            $user = User::where(['email'=> request('email'), 'password' => request('password')])->get();
            if (! auth()->attempt(request(['email', 'password'])))
            {
                if (! auth()->loginUsingId($user->id))
                {
                    return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
                }
            }
            if (Auth::user()) {
                echo 'ingelogd';
            }
        }
        catch (\Exception $e) {
            return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
        }
    }
}
