<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use App\Trip;
use App\User;
use App\Zip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Shows the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param Request $request
     * @param $sUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showUserData(Request $request)
    {
        $sUserName = Auth::user()->username;

        $aUserData = User::select()
            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
            ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
            ->join('trips', 'travellers.trip_id', '=', 'trips.trip_id')
            ->join('majors', 'travellers.major_id', '=', 'majors.major_id')
            ->join('studies', 'majors.study_id', '=', 'studies.study_id')
            ->where('users.username', '=', $sUserName) //r-nummer
            ->first();


        if(str_contains($request->path(), 'edit')){
            $oTrips = Trip::select()->where('is_active', '=', true)->get();
            $oZips = Zip::all();
            $oStudies = Study::all();
            $oMajors = Major::where("study_id", $aUserData->study_id)->get();
            return view('user.profile.profileEdit', ['aUserData' => $aUserData, 'oTrips' => $oTrips, 'oZips' => $oZips, 'oStudies' => $oStudies, 'oMajors' => $oMajors]);
        }
        return view('user.profile.profile', ['aUserData' => $aUserData]);
    }

    /**
     * Updates the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param Request $aRequest
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserData(Request $aRequest, $sUserName)
    {

        $aRequest->validate([
            'LastName'      => 'required',
            'FirstName'     => 'required',
            'IBAN'          => 'required|iban',

            'BirthDate'     => 'required',
            'Birthplace'    => 'required',
            'Nationality'   => 'required',
            'Address'       => 'required',
            'Country'       => 'required',

            'Phone'         => 'required|phone:BE',
            'icePhone1'     => 'required|phone:BE',
            'icePhone2'     => 'nullable|phone:BE'
        ],$this->messages());

        User::where('users.username', '=', $sUserName) //r-nummer
            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
            ->update(
                [
                    'last_name'         => $aRequest->post('LastName'),
                    'first_name'        => $aRequest->post('FirstName'),
                    'gender'            => $aRequest->post('Gender'),
                    'major_id'          => $aRequest->post('Major'),
                    'trip_id'           => $aRequest->post('Trip'),
                    'iban'              => $aRequest->post('IBAN'),
                    'medical_issue'     => $aRequest->post('MedicalIssue'),
                    'medical_info'      => $aRequest->post('MedicalInfo'),

                    'birthdate'         => $aRequest->post('BirthDate'),
                    'birthplace'        => $aRequest->post('Birthplace'),
                    'nationality'       => $aRequest->post('Nationality'),
                    'address'           => $aRequest->post('Address'),
                    'zip_id'            => $aRequest->post('City'),
                    'country'           => $aRequest->post('Country'),
                    'phone'             => $aRequest->post('Phone'),
                    'emergency_phone_1' => $aRequest->post('icePhone1'),
                    'emergency_phone_2' => $aRequest->post('icePhone2'),
                ]
            );

        return redirect('profile');
    }
    /**
     * @author Joren Meynen
     *
     * @return array
     */
    public function messages()
    {
        return [
            'LastName.required'     => 'U heeft geen achternaam ingevuld.',
            'FirstName.required'    => 'U heeft geen voornaam ingevuld.',
            'IBAN.required'         => 'U heeft geen IBAN-nummer ingevuld.',
            'iban'                  => 'U heeft geen geldig IBAN-nummer ingevuld.',
            'BirthDate.required'    => 'U heeft geen geboortedatum ingevuld.',
            'Birthplace.required'   => 'U heeft geen geboorteplaats ingevuld.',
            'Nationality.required'  => 'U heeft geen nationaliteit ingevuld.',
            'Address.required'      => 'U heeft geen adres ingevuld.',
            'Country.required'      => 'U heeft geen land ingevuld.',

            'Phone.required'        => 'U heeft geen GSM-nummer ingevuld.',
            'Phone.phone'           => 'U heeft geen geldig GSM-nummer ingevuld.',
            'icePhone1.required'    => 'U heeft bij \'noodnummer 1\' niets ingevuld.',
            'icePhone1.phone'    => 'U heeft bij \'noodnummer 1\' niets geldig ingevuld.',
            'icePhone2.phone'    => 'U heeft bij \'noodnummer 2\' niets geldig ingevuld.',
        ];
    }
}
