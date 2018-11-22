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
    public function store(Request $request)
    {
        return redirect('info');
        $x = "test";
        return var_dump($x);
        try
        {
            if (Auth::attempt(['email' => $request->get('username'), 'password' => $request->get('password')])) {
                echo Auth::user();
            }
            else{
                echo "blup";
            }
        }
        catch (\Exception $e) {
            return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
        }


    }
    /**
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Logout the user and sends him back to the info page.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/info');
    }
}
