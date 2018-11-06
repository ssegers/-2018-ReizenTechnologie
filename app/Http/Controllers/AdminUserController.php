<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{


    public function createForm()
    {
        //gets the username for the placeholder
        $sUserName = User::where('user_id', 1)->first();

        //returns the view with the data for placeholder
        return view('admin.users.default-user', ['sUserName' => $sUserName->username] );
    }



    public function createUser(Request $request)
    {

        //gets the data from the view and update the table
        try
        {
            User::where('user_id',1)->update(['username'=> $request->post('username'),'password'=>bcrypt($request->post('password'))]);
            return redirect()->back()->with('message', 'Het standaardaccount is aangepast');

        }

        //when the username is a duplicate one, it returns the view with the alert message
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->back()->with('alert-message', 'Fout! De gebruikersnaam die je wilt ingeven bestaat al.');
        }











    }
}
