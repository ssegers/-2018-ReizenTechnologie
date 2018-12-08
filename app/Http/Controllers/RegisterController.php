<?php
namespace App\Http\Controllers;
use App\Mail\RegisterComplete;
use App\Traveller;
use App\User;
use App\Trip;
use App\Study;
use App\Major;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Zip;

class RegisterController extends Controller
{
    /**
     * @author Daan Vandebosch
     * @return \Exception|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * Get's register session data and saves it to database.
     */
    function __construct() {
        $this->middleware('auth');
        $this->middleware('guest');

        try{
            session_start();
        }
        catch (\Exception $ex){
            session_reset();
        }
    }
    function __destruct() {
        session_abort();
    }

    /**
     * This function returns a random password
     *
     * @author Daan Vandebosch
     *
     * @return string
     */
    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function sendMail($email, $name, $password) {
        $aMailData = [
            'subject' => 'Your registration for the UCLL trip.',
            'username' => $name,
            'email' => $email,
            'description' => "berichtje",
            'password' => $password
        ];
        Mail::to($email)->send(new RegisterComplete($aMailData));
    }


    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Gets the travellers, trip, majors and studies and returns them with the step1 view
     */
    public function step0(){
        return view('user.form.step0');
    }

    public function step0Post() {
        return redirect('/user/form/step-1');
    }

    public function step1(Request $request) {
//        $traveller = $request->session()->get('traveller');
//        $user = $request->session()->get('user');

        $aTrips = Trip::where('is_active', true)->orderBy('name')->pluck('name', 'trip_id');
        $aStudies = Study::pluck('study_name','study_id');

        /* Read all data from session */
        $sEnteredUsername = $request->session()->get('sEnteredUsername', '');
        $iSelectedTripId = $request->session()->get('iSelectedTripId', '');
        $iSelectedStudyId = $request->session()->get('iSelectedStudyId', '');
        $iSelectedMajorId = $request->session()->get('iSelectedMajorId', '');

        /* Combine Major list with default value */
        $aMajors = array_merge([null => 'Selecteer eerst een opleiding'],
            Major::where('study_id', $iSelectedStudyId)->pluck('major_name', 'major_id')->toArray()
        );

        return view('user.form.step1', [
//            'traveller' => $traveller,
//            'user' => $user,
            'aTrips' => $aTrips,
            'aStudies' => $aStudies,
            'aMajors' => $aMajors,

            'sEnteredUsername' => $sEnteredUsername,
            'iSelectedTripId' => $iSelectedTripId,
            'iSelectedStudyId' => $iSelectedStudyId,
            'iSelectedMajorId' => $iSelectedMajorId,
        ]);
    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Validates the request data, puts the request data in a traveller and puts it in the session returns a redirect to step 2
     */
    public function step1Post(Request $request) {
        $validator = Validator::make($request->all(), [
            'dropReis' => 'required',
            'txtStudentNummer' => 'required | filled | regex:^[ruRU]^ | min:8 | max:8',
            'dropOpleiding' => 'required',
            'dropAfstudeerrichtingen' => 'required',
        ],$this->messages());

        /* Put all user input in the session */
        $request->session()->put('sEnteredUsername', $request->post('txtStudentNummer'));
        $request->session()->put('iSelectedTripId', $request->post('dropReis'));
        $request->session()->put('iSelectedStudyId', $request->post('dropOpleiding'));
        $request->session()->put('iSelectedMajorId', $request->post('dropAfstudeerrichtingen'));

        /* Before validator runs, reset page validation */
        $request->session()->put('validated-step-1', false);

        /* Validate the request */
        $validatedData = $validator->validate();

        /* When validator succeed save validation */
        $request->session()->put('validated-step-1', true);

//        $sUserRole = $this->checkRole($validatedData['txtStudentNummer']);

//        if((empty($request->session()->get('traveller')) || empty($request->session()->get('user')))) {
//            $traveller = new Traveller();
//            $traveller->fill(['trip_id' => $validatedData['dropReis'],
//                'major_id' => $validatedData['dropAfstudeerrichtingen']]);
//
//            $user = new User();
//            $user->fill(['username' => $validatedData['txtStudentNummer'], 'role' => $sUserRole]);
//            $request->session()->put('traveller', $traveller);
//            $request->session()->put('user', $user);
//        } else {
//            $traveller = $request->session()->get('traveller');
//            $traveller->fill(['trip_id' => $validatedData['dropReis'],
//            'major_id' => $validatedData['dropAfstudeerrichtingen']]);
//
//            $user = $request->session()->get('user');
//            $user->fill(['username' => $validatedData['txtStudentNummer'], 'role' => $sUserRole]);
//
//            $request->session()->put('traveller', $traveller);
//            $request->session()->put('user', $user);
//        }
        return redirect('/user/form/step-2');
    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Gets the traveller from the session, gets zip codes, cities and returns the step 2 view
     */
    public function step2(Request $request) {
        /* Read all data from session */
        $sEnteredLastName = $request->session()->get('sEnteredLastName', '');
        $sEnteredFirstName = $request->session()->get('sEnteredFirstName', '');
        $sCheckedGender = $request->session()->get('sCheckedGender', '');
        $sEnteredNationality = $request->session()->get('sEnteredNationality', '');
        $sEnteredBirthDate = $request->session()->get('sEnteredBirthDate', '');
        $sEnteredBirthPlace = $request->session()->get('sEnteredBirthPlace', '');
        $sEnteredAddress = $request->session()->get('sEnteredAddress', '');
        $iSelectedCityId = $request->session()->get('iSelectedCityId', 0);
        $sEnteredCountry = $request->session()->get('sEnteredCountry', '');
        $sEnteredIban = $request->session()->get('sEnteredIban', '');
        $sEnteredBic = $request->session()->get('sEnteredBic', '');

//        $traveller = $request->session()->get('traveller');
        $aCities = Zip::orderBy('zip_code')->get();

        $aGenderOptions = array(
            'man' => 'Man',
            'vrouw' => 'Vrouw',
            'anders' => 'Anders',
        );

//        return var_dump($aGenderOptions);
//        return var_dump($request->session());

        return view('user.form.step2',[
//            'traveller' => $traveller,
            'aCities' => $aCities,
            'aGenderOptions' => $aGenderOptions,

            'sEnteredLastName' => $sEnteredLastName,
            'sEnteredFirstName' => $sEnteredFirstName,
            'sCheckedGender' => $sCheckedGender,
            'sEnteredNationality' => $sEnteredNationality,
            'sEnteredBirthDate' => $sEnteredBirthDate,
            'sEnteredBirthPlace' => $sEnteredBirthPlace,
            'sEnteredAddress' => $sEnteredAddress,
            'iSelectedCityId' => $iSelectedCityId,
            'sEnteredCountry' => $sEnteredCountry,
            'sEnteredIban' => $sEnteredIban,
            'sEnteredBic' => $sEnteredBic,
        ]);
    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Validates the request data and puts the data in a traveller then puts it in the session.
     * Returns a redirect to the next step in the form
     */
    public function step2Post(Request $request) {

        $validator = Validator::make($request->all(), [
            'txtNaam' => 'required',
            'txtVoornaam' => 'required',
            'gender' => 'required',
            'txtNationaliteit' => 'required',
            'dateGeboorte' => 'required',
            'txtGeboorteplaats' => 'required',
            'txtAdres' => 'required',
            'dropGemeentes' => 'required',
            'txtLand' => 'required',
            'txtBank' => 'required | iban',
            'txtBic' => 'required | bic',
        ],$this->messages());

        /* Put all the data in the session */
        $request->session()->put('sEnteredLastName', $request->post('txtNaam'));
        $request->session()->put('sEnteredFirstName', $request->post('txtVoornaam'));
        $request->session()->put('sCheckedGender', $request->post('gender'));
        $request->session()->put('sEnteredNationality', $request->post('txtNationaliteit'));
        $request->session()->put('sEnteredBirthDate', $request->post('dateGeboorte'));
        $request->session()->put('sEnteredBirthPlace', $request->post('txtGeboorteplaats'));
        $request->session()->put('sEnteredAddress', $request->post('txtAdres'));
        $request->session()->put('iSelectedCityId', $request->post('dropGemeentes'));
        $request->session()->put('sEnteredCountry', $request->post('txtLand'));
        $request->session()->put('sEnteredIban', $request->post('txtBank'));
        $request->session()->put('sEnteredBic', $request->post('txtBic'));


        /* Before validator runs, reset page validation */
        $request->session()->put('validated-step-2', false);

        /* Validate the request */
        $validatedData = $validator->validate();

        /* When validator succeed save validation */
        $request->session()->put('validated-step-2', true);

//        return var_dump($request->session());


//        $traveller = $request->session()->get('traveller');
//        $iZipId = Zip::where('city', $validatedData['dropGemeentes'])->pluck('zip_id')->first();
//        $traveller->fill(['first_name' => $validatedData['txtVoornaam'],
//            'last_name' => $validatedData['txtNaam'],
//            'gender' => $validatedData['gender'],
//            'nationality' => $validatedData['txtNationaliteit'],
//            'birthdate' => $validatedData['dateGeboorte'],
//            'birthplace' => $validatedData['txtGeboorteplaats'],
//            'address' => $validatedData['txtAdres'],
//            'zip_id' => $iZipId,
//            'country' => $validatedData['txtLand'],
//            'iban' => $validatedData['txtBank'],
//                ]);
//
//
//        $request->session()->put('traveller', $traveller);

        return redirect('/user/form/step-3');
    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Gets the traveller from the session and returns it with the step3 view
     */
    public function step3(Request $request) {
        $traveller = $request->session()->get('traveller');
        $user = $request->session()->get('user');
        return view('user.form.step3',['traveller'=> $traveller, 'user' => $user]);
    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Validates request data and redirects to the next step in the form
     */
    public function step3Post(Request $request) {
        $validator = Validator::make($request->all(), [
            'txtEmail' => 'required',
            'txtGsm' => 'required|phone:BE | phone:NL',
            'txtNoodnummer1' => 'required|phone:BE | phone:NL',
            'txtNoodnummer2' => 'nullable|phone:BE | phone:NL',
            'radioMedisch' => 'required',
            'txtMedisch' => '',
        ],$this->messages());

        $validatedData = $validator->validate();

        $traveller = $request->session()->get('traveller');
        $traveller->fill(['email' => $validatedData['txtEmail'],
            'phone' => $validatedData['txtGsm'],
            'emergency_phone_1' => $validatedData['txtNoodnummer1'],
            'medical_issue' => $validatedData['radioMedisch'],
            'medical_info' => $validatedData['txtMedisch'],
        ]);
        if(isset($validatedData['txtNoodnummer2'])) {
            $traveller->fill(['emergency_phone_2' => $validatedData['txtNoodnummer2']]);
        }

        $request->session()->put('traveller', $traveller);

        $user = $request->session()->get('user');
        $user->password = $this->randomPassword();
        $user->save();
        $traveller->fill(['user_id' => $user->user_id]);
        $traveller->save();
        $this->sendMail($traveller->email, $user->username, $user->password);
        return redirect('/info')->with('message', 'Je hebt je succesvol geregistreert voor een reis!');
    }

    private function checkRole($sUsername) {
        if(substr($sUsername,0,1) == 'r' || substr($sUsername,0,1) == 'R') {
            return "traveller";
        } else {
            return "guide";
        }
    }

    public function GetMajorsByStudy(Request $request){
        $study = $request->get('study');
        $majors = Major::select()
            ->where("study_id", $study)
            ->get();

    }
    /**
     * @author Nico Schelfhout & Kaan
     * @return array
     * Returns an array of all validator messages.
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute field must be filled in',
            'txtStudentNummer.required' => 'Je Studenten-/docentennummer moet ingevuld worden.',
            'txtStudentNummer.regex' => 'Een studenten-/docentennummer moet beginnen met een r of een u',
            'txtStudentNummer.min' => 'Een studenten-/docentennummer heeft 1 letter en 7 cijfers',
            'txtStudentNummer.max' => 'Een studenten-/docentennummer heeft 1 letter en 7 cijfers',
            'txtWachtwoord.required'  => 'Je moet een wachtwoord invullen.',
            'txtWachtwoord_confirmation.required'  => 'Je moet je wachtwoord bevestigen.',
            'txtWachtwoord.min' => 'Je wachtwoord moet minsten uit 8 tekens bestaan.',
            'txtWachtwoord.confirmed' => 'Je opgegeven paswoorden komen niet met elkaar overeen.',
            'radio.required' => 'Geef aan als je een student/docent bent of niet.',
            'txtEmail.required' => 'Vul je email adres in.',
            'txtEmail.email' => 'Het ingevulde email adres is niet geldig.',
            'txtEmail.unique' => 'Het ingevulde email adres is al in gebruik.',
            'txtNummer.unique' => 'Het ingevulde Studenten-/docentennummer is al in gebruik.',
            'dropReis.required' => 'Je moet een reis kiezen.',
            'dropOpleiding.required' => 'Je moet een opleiding kiezen.',
            'dropAfstudeerrichting.required' => 'Je moet een afstudeerrichting kiezen.',
            'txtNaam.required' => 'Je moet je achternaam invullen.',
            'txtVoornaam.required' => 'Je moet je voornaam invullen.',
            'gender.required' => 'Je moet een geslacht kiezen.',
            'dateGeboorte.required' => 'Je moet je geboorte datum ingeven.',
            'dateGeboorte.date_format' => 'De waarde die je hebt ingevuld hebt bij geboorte datum in ongeldig',
            'txtGeboorteplaats.required' => 'Je moet je geboorte plaats ingeven.',
            'txtNationaliteit.required' => 'je moet je nationaliteit opgeven.',
            'Postcode.required' => 'Je moet je postcode ingeven.',
            'dropGemeente.required' => 'Je moet je gemeente ingeven.',
            'txtLand.required' => 'Je moet je land ingeven',
            'txtAdres.required' => 'Je moet je adres ingeven.',
            'txtBank.required' => 'Je moet je IBAN nummer ingeven.',
            'iban' => 'Je moet een geldig IBAN nummer ingeven.',
            'txtBic.required' => 'Je moet je BIC nummer ingeven.',
            'bic' => 'Je moet een geldig BIC nummer ingeven',
            'txtGsm.required' => 'Je moet je GSM nummer invullen.',
            'txtGsm.phone' => 'Je moet een geldig GSM nummer invullen.',
            'txtNoodnummer1.required' => 'Je moet minstens 1 noodnummer invullen.',
            'txtNoodnummer1.phone' => 'Je moet een geldig noodnummer 1 invullen.',
            'txtNoodnummer2.phone' => 'Je moet een geldig noodnummer 2 invullen.',
            'medical_issue.required' => 'Je moet aanduiden indien je een medische behandeling volgt of niet.',
        ];
    }
}


