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

    public function ResetPassword(Request $request)
    {
        $p1 = $request->input('password1');
        $p2 = $request->input('password2');
        $userid = $request->input('userid');
        $GivenToken = $request->input("fulltoken");
        $user = User::where('user_id',$userid)->first();
        $userToken = $user->resettoken;
        if($this->IsTokenStillValid($userToken,$GivenToken)){
            if ($p1 == $p2){
                if (strlen($p1) >= 9){
                    User::where('user_id',$userid)->update(['password' => bcrypt($p1),"resettoken" => ""]);
                    return redirect()->route("info")->with('message', 'Paswoord is aangepast.');
                }
                else{
                    return back()->with('message', 'Het paswoord moet minstens 8 tekens lang zijn.');
                }
            }
                else{
                    return back()->with('message', 'Paswoorden komen niet met elkaar overeen.');
                }
            }
        else {
            return redirect()->route("info")->with('errormessage', 'Deze link is niet meer beschikbaar.');
        }
    }

    public function ShowResetPassword($token)
    {
        $userid = explode("*", $token)[1];
        $user = User::where('user_id',$userid)->first();
        $userToken = $user->resettoken;
        if ($this->IsTokenStillValid($userToken,$token)){
            if (Auth::check()){
                return redirect(\route('info'));
            }
            else{
                return view("auth.passwords.resetpassword", ["userid"=>$userid,"fulltoken"=>$token]);
            }
        }
        else{
            return redirect()->route("info")->with('errormessage', 'Deze link is niet meer beschikbaar.');
        }
    }

    private function IsTokenStillValid($tokenUser, $GivenToken){
        $year = substr($GivenToken,0,4);
        $month = substr($GivenToken,4,2);
        $day = substr($GivenToken,6,2);
        $hour = substr($GivenToken,8,2);
        $minute = substr($GivenToken,10,2);
        $TokenTime = Carbon::create($year,$month,$day,$hour,$minute);
        if($tokenUser == $GivenToken){
            if (Carbon::now()->diffInMinutes($TokenTime) < 30){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function ShowEmail()
    {
        if (Auth::check()){
            return redirect(route('info'));
        }
        else{
            return view('auth.passwords.enteremail');
        }
    }

    public function ShowEmailPost(Request $request){
        $traveller = Traveller::where('email', $request->input('email'))->first();
        if ($traveller == ""){
            return back()->with('message', 'Geen gebruiker gevonden met dit emailadres.');
        }
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
        $token = $year.$month.$day.$hour.$minute.RegisterController::randomPassword(25).'*'.$travellerid;
        if (User::where('user_id',$travellerid)->update(['resettoken' => $token])){
            $this->sendMail($request->input('email'),$naam, $token);
            return redirect()->route("info")->with('message', 'Mail is verstuurd.');
        }
        else{
            return redirect()->route("info")->with('errormessage', 'Er is een fout opgetreden met het versturen van de mail, probeer later opnieuw.');
        }
    }

    public function sendMail($email, $name, $token) {
        $aMailData = [
            'subject' => 'Password reset',
            'fullname' => $name,
            'email' => $email,
            'token' => $token
        ];
        try{
            Mail::to($email)->send(new ResetPas($aMailData));
        }
        catch (\Exception $ex){
            return redirect()->route("info")->with('errormessage', "mail sturen niet gelukt, probeer opnieuw.");

        }
    }
}
