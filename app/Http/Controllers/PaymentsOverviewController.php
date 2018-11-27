<?php

namespace App\Http\Controllers;

use App\Mail\PaymentStatus;
use App\Traveller;
use Illuminate\Http\Request;

class PaymentsOverviewController extends Controller
{
    protected $aFiltersChecked = array(
        'last_name' => 'Familienaam',
        'first_name' => 'Voornaam',
        'study_name'=>'Richting',
        'major_name'=>'Afstudeerrichting',
        'price'=>'Saldo',
        'amount'=>'Betaald',
    );
    /**
     * Generates a list of travellers with info on payments, based on filters.
     *
     * @author Nico Schelfhout
     *
     * @param Request $request
     * @param $sUserName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showPaymentInfoAsMentor(Request $request, $sUserName){
        /* Get user from Auth */
        $oUser = Auth::user();

        /* Get user from URL */
        $oUser = User::where('username', $sUserName)->first();

        /* Check if user exist and is a organizer */
        try {
            if ($oUser->role != 'organizer') {
                return 'Deze gebruiker is niet gemachtigd';
            }
        }
        catch (\Exception $exception) {
            return 'Deze gebruiker bestaat niet';
        }
        $aOrganizerTrip = Trip::where('user_id', $oUser->user_id)->where('is_active', true)
            ->join('travellers', 'trips.trip_id', '=', 'travellers.trip_id')
            ->first();

        $aFiltersChecked = $this->aFiltersChecked;

        $aActiveTrips = array();
        foreach (Trip::where('is_active', true)->get() as $oTrip) {
            array_push($aActiveTrips, array(
                'oTrip' => $oTrip,
                'iCount' => Traveller::where('trip_id', $oTrip->trip_id)
                    ->get()
                    ->count(),
            ));
        }
        /* Save th active pagination */
        $aPaginate = array(
            '5' => false,
            '10' => false,
            '15' => false,
            '20' => false,
            '25' => false,
        );
        if ($iPaginate = $request->post('per-page')) {
            $aPaginate[$iPaginate] = true;
        }
        else {
            $aPaginate[$iPaginate = 15] = true;
        }
        /* Get the travellers based on the applied filters */
        $aUserData = $this->getUserData($aFiltersChecked, $aOrganizerTrip, $iPaginate);


        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFiltersChecked' => $aFiltersChecked,
            'sUserName' => $oUser->username,
            'oCurrentTrip' => $aOrganizerTrip,
            'aActiveTrips' => $aActiveTrips,
            'aPaginate' => $aPaginate,
        ]);
    }

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
    private function getUserData($aFilters, $iTrip, $iPaginate = false) {
        if ($iPaginate) {
            /* For click event: Add name to selection */
            return Traveller::select(array_keys(array_add($aFilters, 'username', true)))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTrip->trip_id)->paginate($iPaginate);
        }
        return Traveller::select(array_keys($aFilters))
            ->join('users','travellers.user_id','=','users.user_id')
            ->join('majors','travellers.major_id','=','majors.major_id')
            ->join('studies','majors.study_id','=','studies.study_id')
            ->where('trip_id', $iTrip->trip_id)->get()->toArray();
    }
}
