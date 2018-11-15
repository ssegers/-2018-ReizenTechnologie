<?php

namespace App\Http\Controllers;

use App\Trip;
use FontLib\Table\Type\post;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    //
    public function getInfo(){
        $oActiveTrips = Trip::where('is_active',true)->where('contact_mail', '!=' , null)->get();
        return view('guest.contactpage',array('oActiveTrips'=>$oActiveTrips));
    }
    public function sendMail(Request $request){
        $oTrip = Trip::where('trip_id',$request->post("reis"));
        $sMail = $oTrip->contact_mail;
        $sOnderwerp = post("onderwerp");
        $sbericht = post('bericht');

        
    }

}
