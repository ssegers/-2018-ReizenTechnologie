<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Trip;
use FontLib\Table\Type\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    //
    public function getInfo(){
        $oActiveTrips = Trip::where('is_active',true)->where('contact_mail', '!=' , null)->get();
        return view('guest.contactpage',array('oActiveTrips'=>$oActiveTrips));
    }
    public function sendMail(Request $request){
        $oTrip = Trip::where('trip_id',(int)$request->post("reis"))->pluck('contact_mail');
        $sMail = $oTrip;
        $sOnderwerp = $request->post("onderwerp");
        $sbericht = $request->post('bericht');
        $sMail = substr($sMail,2,strlen($sMail)-4);
        $this->sendMailTo($sMail, $sOnderwerp, $sbericht);
    }

    public function sendMailTo($email,$subject, $bericht) {
        $aMailData = [
            'subject' => $subject,
            'email' => $email,
            'description' => $bericht,
        ];
        Mail::to($email)->send(new ContactMail($aMailData));
    }



}
