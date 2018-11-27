<?php

namespace App\Http\Controllers;

use App\Mail\PaymentStatus;
use App\Traveller;
use App\Trip;
use Illuminate\Http\Request;

class PaymentsOverviewController extends Controller
{
    //
    public function sendMailToStudentsInTrip($sTripId,$sBegeleider){
        $oStudents = Traveller::where('trip_id',$sTripId)->get();
        $sTripNaam = Trip::where('trip_id',$sTripId)->first()->pluck('name');
        $iPrijs=Trip::where('trip_id',$sTripId)->first()->pluck('price');
        $iBetaald = 0;
        foreach ($oStudents as $oStudent){
            $this->sendMailTo($oStudent->email,$oStudent->first_name,$iBetaald, $iPrijs-$iBetaald,$sTripNaam,$sBegeleider);
        }

        }

        public function sendMailTo($email, $studentNaam,$betaald,$teBetalen,$reisNaam,$begeleider) {
            $aMailData = [
                'studentNaam' => $studentNaam,
                'email' => $email,
                'betaald' => $betaald,
                'teBetalen'=>$teBetalen,
                'reisNaam'=>$reisNaam,
                'begeleider'=>$begeleider
            ];
            Mail::to($email)->send(new PaymentStatus($aMailData));
        }

}
