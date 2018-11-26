<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateMailController extends Controller
{
    public function createForm(){

        return view('organiser.updatemail');
    }



    public function createMail(Request $request)
    {


        return redirect()->back();
    }
}
