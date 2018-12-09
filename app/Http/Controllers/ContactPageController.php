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
        $request->validate([
            'email' => 'required',
            'onderwerp' => 'required|max:160',
            'bericht' => 'required',
            'captcha' => 'required|captcha'
        ],['captcha.captcha'=>'Foute captcha code.']);

        $oTrip = Trip::where('trip_id',(int)$request->post("reis"))->pluck('contact_mail');
        $sMail = $oTrip;
        $sContactMail = $request->post("email");
        $sOnderwerp = $request->post("onderwerp");
        $sbericht = $request->post('bericht');
        $sMail = substr($sMail,2,strlen($sMail)-4);
        $this->sendMailTo($sMail, $sOnderwerp, $sbericht, $sContactMail);
        return redirect('info')->with('message', 'De e-mail is succesvol verzonden.');
    }
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function sendMailTo($email,$subject, $bericht,$contactMail) {
        $aMailData = [
            'subject' => $subject,
            'email' => $email,
            'description' => $bericht,
            'cmail'=>$contactMail,
        ];
        Mail::to($email)->send(new ContactMail($aMailData));
    }



}
