<?php

namespace App\Http\Controllers;

use App\Mail\PaymentStatus;
use App\Traveller;
use Illuminate\Http\Request;

class PaymentsOverviewController extends Controller
{
    //
    public function sendMailToStudentsInTrip($sTripId){
        $oStudents = Traveller::where('trip_id',$sTripId)->get();
        $iPrijs=0;
        foreach ($oStudents as $oStudent){

        }

        }

        public function sendMailTo($email, $studentNaam,$betaald,$teBetalen,$reisNaam) {
            $aMailData = [
                'studentNaam' => $studentNaam,
                'email' => $email,
                'betaald' => $betaald,
                'teBetalen'=>$teBetalen,
                'reisNaam'=>$reisNaam
            ];
            Mail::to($email)->send(new PaymentStatus($aMailData));
        }

}
