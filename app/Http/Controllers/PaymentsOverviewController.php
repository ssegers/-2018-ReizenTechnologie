<?php

namespace App\Http\Controllers;

use App\Mail\PaymentStatus;
use App\Payment;
use App\Traveller;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsOverviewController extends Controller
{

    public function showTable(){
        $userdata= DB::table('travellers')
            ->join('majors', 'travellers.major_id', '=', 'majors.major_id')
            ->join('studies','majors.study_id', '=', 'studies.study_id')
            ->join('payments', 'travellers.traveller_id','=','payments.traveller_id')
            ->select('travellers.*','studies.study_name', 'majors.major_name', 'payments.*')
            ->get();

        return view('user.payment.pay_overview',['userdata' => $userdata]);
    }


    public function sendMailToStudentsInTrip($sTripId,$sBegeleider){
        $oStudents = Traveller::where('trip_id',$sTripId)->get();
        $sTripNaam = Trip::where('trip_id',$sTripId)->first()->pluck('name');
        $iPrijs=Trip::where('trip_id',$sTripId)->first()->pluck('price');
        foreach ($oStudents as $oStudent){
            $aBetalingen = Payment::where('traveller_id',$oStudent->traveller_id)->get()->pluck('amount');
            $iBetaald = 0;
            foreach ($aBetalingen as $iAmount){
                $iBetaald+=$iAmount;
            }
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
