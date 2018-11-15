<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    //
    public function getInfo(){
        $oActiveTrips = Trip::where('is_active',true);
        return view('guest.contactpage',array('oActiveTrips'=>$oActiveTrips));
    }
    public function sendMail(){
        
    }

}
