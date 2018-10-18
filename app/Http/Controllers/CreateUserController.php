<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateUserController extends Controller
{


    public function createForm()
    {
        $sUserName = User::where('user_id', 1)->first();

        return view('user.Create.create', ['sUserName' => $sUserName->name] );
    }

    //Creates a global user account and stores it into the database

    public function createUser(Request $request)
    {

            User::where('user_id',1)->update(['name'=> $request->post('username'),
                'password'=>bcrypt($request->post('password'))]);



         return redirect('user/Create/create')->with('message', 'De standaard gebruiker is ingesteld!');
    }
}
