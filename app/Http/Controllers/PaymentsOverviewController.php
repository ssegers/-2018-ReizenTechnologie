<?php

namespace App\Http\Controllers;

use App\Mail\PaymentStatus;
use App\Payment;
use App\Traveller;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentsOverviewController extends Controller
{
    /**
     * Shows table with userdata(traveller, study, payment)
     * @author Nico Schelfhout
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTable(){
        $userdata = Traveller::getTravellersWithPayment();
        foreach($userdata as $oUserData){
            $paymentsum[$oUserData['traveller_id']] = DB::table('payments')->where('traveller_id', '=', $oUserData['traveller_id'])->sum('amount');
        }


        return view('user.payment.pay_overview',['userdata' => $userdata, 'paymentsum' => $paymentsum ]);
    }

    /**
     * @author Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPayment(Request $request)
    {

        //Get the input
        $input = $request->all();

        //Get the validation rules
        $rules = [
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required',
        ];

        //Get the messages
        $messages = $this->messages();

        //Validation
        $validator = Validator::make($input,$rules,$messages );

        //If the validation fails, return back to the view with the errors and the input you've given
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Insert new record into table
        Payment::insert([
            'amount' => $request->post('amount'),
            'payment_date' => $request->post('payment_date'),
            'traveller_id' => $request->post('traveller_id')

        ]);
        //return back to the view with the succes message

        return back();

    }


    /**Author: Nico Schelfhout
     * @return array
     *
     * Returns an array with custom error messages
     */
    private function messages(){
        return [
            'amount.required' => 'Gelieve een betaling toe te voegen',
            'amount.numeric' => 'Een betaling kan enkel getallen bevatten',
            'amount.min' => 'U kan niet minder dan 0 betalen',
            'amount.max' => 'U kan niet meer betalen dan de prijs van de reis',
            'payment_date.required'=>'Gelieve een datum toe te voegen'


        ];
    }

    public function sendMail(Request $request){
        $bsendMail = $request->post("sendMail");
        $this->sendMailToStudentsInTrip(2,"Rudi");
        return response()->json(['mailsSent' => true]);
    }

    public function sendMailToStudentsInTrip($sTripId,$sBegeleider){
        $oStudents = Traveller::where('trip_id',$sTripId)->get();
        $sTrip = Trip::where('trip_id',$sTripId)->first();
        $sTripNaam = $sTrip->naam;
        $iPrijs=$sTrip->price;
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
