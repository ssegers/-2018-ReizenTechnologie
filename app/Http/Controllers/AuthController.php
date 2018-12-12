<?php

namespace App\Http\Controllers;

use App\Mail\ResetPas;
use App\Traveller;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Routing\Route;


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
                    return redirect('/admin/info');
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

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/info');
    }

    public function showView(){
        if (Auth::check()){
            return (route("info"));
        }
        else{
            return view("auth.Authenticate");
        }
    }

    public function ResetPassword(Request $request, $token)
    {

    }

    public function ShowResetPassword($token)
    {
        $t = $token;
        $year = substr($t,0,4);
        $month = substr($t,4,2);
        $day = substr($t,6,2);

        return $day;
        return view('auth.passwords.resetpassword');
    }

    public function ShowEmail()
    {
        return view('auth.passwords.enteremail');
    }

    public function ShowEmailPost(Request $request){
        $traveller = Traveller::where('email', $request->input('email'))->first();
        $travellerid = $traveller->user_id;
        $voornaam = $traveller->first_name;
        $achternaam = $traveller->last_name;
        $naam = $voornaam . " " . $achternaam;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        if ($month < 10){
            $month = '0'. $month;
        }
        $day = Carbon::now()->day;
        if ($day < 10){
            $day = '0'. $day;
        }
        $hour = (string)Carbon::now()->hour;
        if ($hour < 10){
            $hour = '0'. $hour;
        }
        $minute = Carbon::now()->minute;
        if ($minute < 10){
            $minute = '0'. $minute;
        }
        $token = $year.$month.$day.$hour.$minute.RegisterController::randomPassword(25);
        return $token;
        if (User::where('user_id',$travellerid)->update(['resettoken' => $token])){
            $this->sendMail($request->input('email'),$naam, $token);
        }
        else{
            return redirect(route('info'));
        }
    }

    public function sendMail($email, $name, $token) {
        $aMailData = [
            'subject' => 'Password reset',
            'fullname' => $name,
            'email' => $email,
            'token' => $token
        ];
        Mail::to($email)->send(new ResetPas($aMailData));
    }
}
