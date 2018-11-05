<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{


    public function createForm()
    {
        //get the username for the placeholder
        $sUserName = User::where('user_id', 1)->first();

        //returns the view with the data for placeholder
        return view('admin.users.default-user', ['sUserName' => $sUserName->username] );
    }

    //Creates a global user account and stores it into the database

    public function createUser(Request $request)
    {

            //Get the data from the view and update the table
            User::where('user_id',1)->update(['username'=> $request->post('username'),'password'=>bcrypt($request->post('password'))]);

            //return the view with message
            return redirect()->back()->with('message', 'De standaard gebruiker is ingesteld!');





    }
}
