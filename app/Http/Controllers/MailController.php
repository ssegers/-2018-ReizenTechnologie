<?php

namespace App\Http\Controllers;

use App\Mail\Update;
use App\Traveller;
use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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

        $aTrips = Trip::where('is_active', true)->get();
        $aNewTrips = array();
        foreach ($aTrips as $oTrip) {
            $aNewTrips[$oTrip->trip_id] = $oTrip->name . ' ' . $oTrip->year;
        }


        return view('organiser.updatemail', ['aTrips' => $aNewTrips]);
    }


    /**
     * This method validates and sends the update mail
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendUpdateMail(Request $request)
    {
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

        /* Set the mail data */
        $aMailData = [
            'subject' => $request->post('subject'),
            'trip' => Trip::where('trip_id',$request->post('trip'))->first(),
            'message' => $request->post('message')
        ];

        /* Get the mail list and chunk them by 10 */
       $aMail = Traveller::where('user_id', 4)->pluck('email')->toArray();
        // $aMailList = Traveller::pluck('email')->toArray();

        Mail::to($aMail)->send(new Update($aMailData));

        /* Send the mail to each recipient */
       // foreach ($aMailList as $aMail) {
        //    Mail::to($aMail)->send(new Update($aMailData));
       // }

        return redirect()->back()->with('message', 'De email is succesvol verstuurd!');
    }

    /**
     * This method generates the error messages displayed when the validation fails
     *
     * @author Yoeri op't Roodt
     *
     * @return array
     */
    private function messages() {
        return [
            'subject.required' => 'Het onderwerp moet ingevult zijn',
            'message.required' => 'Het bericht moet ingevult zijn',
            'trip.required' => 'De reis moet geselecteerd zijn'
        ];
    }
}
