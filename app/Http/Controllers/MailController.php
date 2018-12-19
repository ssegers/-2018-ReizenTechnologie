<?php

namespace App\Http\Controllers;

use App\Mail\Update;
use App\Traveller;
use App\TravellersPerTrip;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    /**
     * This method shows the form of the update mail
     *
     * @author Stef Kerkhofs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateForm(){
        $currentUserId = Auth::id();
        $sEmail = Traveller::where('user_id', $currentUserId)->pluck('email')->first();
        $travellerId = Auth::user()->traveller->traveller_id;
        $aTripsPerOrganiser = TravellersPerTrip::where('traveller_id', $travellerId)->where('is_organizer', true)->select('trip_id')->get();

        $aActiveTrips = Trip::where('is_active', true)->whereIn('trip_id', $aTripsPerOrganiser)->get();

        $aNewTrips = array();
        foreach ($aActiveTrips as $oTrip) {
            $aNewTrips[$oTrip->trip_id] = $oTrip->name . ' ' . $oTrip->year;
        }
        return view('organiser.updatemail', ['aTrips' => $aNewTrips, 'sEmail' => $sEmail]);
    }


    /**
     * This method validates and sends the update mail
     *
     * @author Yoeri op't Roodt & Stef Kerkhofs
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendUpdateMail(Request $request)
    {
        if(Auth::user()->role == "admin"){
            return back()->with('danger','U kan geen mail versturen als administrator');
        }
        /* Validate the request */
        $validator = \Validator::make($request->all(), [
            'subject' => 'required',
            'trip' => 'required',
            'message' => 'required',
        ], $this->messages());

        /* Return the errors if the validator fails */
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with(['message' => $validator->errors()]);
        }
        $sContactMail =  $request->post('contactMail');

        /* Set the mail data */
        $aMailData = [
            'subject' => $request->post('subject'),
            'trip' => Trip::where('trip_id',$request->post('trip'))->first(),
            'message' => $request->post('message'),
            'contactMail' => $sContactMail
        ];

        /* Get the mail list and chunk them by 10 */
            $aMailList = array();
           $aAllTravellersPerTrip = TravellersPerTrip::where('trip_id',$request->post('trip'))->get();

           foreach($aAllTravellersPerTrip as $traveller) {
               array_push($aMailList,$traveller->traveller->email);
           }
           $aChunkedMailList = array_chunk($aMailList, 10);



        /* Send the mail to each recipient */
        foreach ($aChunkedMailList as $aChunk) {
            Mail::to($aChunk)->send(new Update($aMailData));
        }

        return redirect()->back()->with('message', 'De email is succesvol verstuurd!');
    }


    /**
     * This method generates the error messages displayed when the validation fails
     *
     * @author Yoeri op't Roodt & Stef Kerkhofs
     *
     * @return array
     */
    private function messages() {
        return [
            'subject.required' => 'Het onderwerp moet ingevuld zijn',
            'message.required' => 'Het bericht moet ingevuld zijn',
            'trip.required' => 'De reis moet geselecteerd zijn'
        ];
    }
}
