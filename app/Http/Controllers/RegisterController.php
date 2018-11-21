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
        session_start();
    }
    function __destruct() {
    }

    function randomPassword() {
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
    public function step1(Request $request) {
        $traveller = $request->session()->get('traveller');
        $aTrips = Trip::where('is_active', true)->orderBy('name')->pluck('name');
        $aStudies = Study::pluck('study_name','study_id');
        return view('user.form.step1',['traveller' => $traveller,'aTrips'=>$aTrips, 'aStudies'=>$aStudies]);
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
        $validatedData = $validator->validate();
        $sUserRole = $this->checkRole($validatedData['txtStudentNummer']);

        if((empty($request->session()->get('traveller')) || empty($request->session()->get('user')))) {
            $traveller = new Traveller();
            $traveller->fill(['trip_id' => $validatedData['dropReis'],
                'major_id' => $validatedData['dropAfstudeerrichtingen']]);

            $user = new User();
            $user->fill(['username' => $validatedData['txtStudentNummer'], 'role' => $sUserRole]);
            $request->session()->put('traveller', $traveller);
            $request->session()->put('user', $user);
        } else {
            $traveller = $request->session()->get('traveller');
            $traveller->fill(['trip_id' => $validatedData['dropReis'],
            'major_id' => $validatedData['dropAfstudeerrichtingen']]);

            $user = $request->session()->get('user');
            $user->fill(['username' => $validatedData['txtStudentNummer'], 'role' => $sUserRole]);

            $request->session()->put('traveller', $traveller);
            $request->session()->put('user', $user);
        }
        return redirect('/user/form/step-2');

    }

    /**
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Gets the traveller from the session, gets zip codes, cities and returns the step 2 view
     */
    public function step2(Request $request) {
        $traveller = $request->session()->get('traveller');
        $aZips = Zip::select('zip_code', 'city')->orderBy('city')->get();
        foreach($aZips as $zip){
            $aGroupedZips[$zip->zip_code][] = $zip->city;
        }
        return view('user.form.step2',['traveller' => $traveller,'aZips' => $aGroupedZips]);
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
        ],$this->messages());

        $validatedData = $validator->validate();

        $traveller = $request->session()->get('traveller');
        $iZipId = Zip::where('city', $validatedData['dropGemeentes'])->pluck('zip_id')->first();
        $traveller->fill(['first_name' => $validatedData['txtVoornaam'],
            'last_name' => $validatedData['txtNaam'],
            'gender' => $validatedData['gender'],
            'nationality' => $validatedData['txtNationaliteit'],
            'birthdate' => $validatedData['dateGeboorte'],
            'birthplace' => $validatedData['txtGeboorteplaats'],
            'address' => $validatedData['txtAdres'],
            'zip_id' => $iZipId,
            'country' => $validatedData['txtLand'],
            'iban' => $validatedData['txtBank'],
                ]);

        $request->session()->put('traveller', $traveller);

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
            'txtGsm' => 'required|numeric',
            'txtNoodnummer1' => 'required',
            'txtNoodnummer2' => '',
            'radioMedisch' => 'required',
            'txtMedisch' => '',
        ],$this->messages());

        $validatedData = $validator->validate();

        $traveller = $request->session()->get('traveller');
        $traveller->fill(['email' => $validatedData['txtEmail'],
            'phone' => $validatedData['txtGsm'],
            'emergency_phone_1' => $validatedData['txtNoodnummer1'],
            'emergency_phone_2' => $validatedData['txtNoodnummer2'],
            'medical_issue' => $validatedData['radioMedisch'],
            'medical_info' => $validatedData['txtMedisch'],
        ]);

        $request->session()->put('traveller', $traveller);

        $user = $request->session()->get('user');
        $user->password = $this->randomPassword();

        $user->save();

        $traveller->fill(['user_id' => $user->user_id]);
        $traveller->save();
        $this->sendMail($traveller->email, $user->username, $user->password);
        return redirect('/info')->with('succes', 'Je hebt je succesvol geregistreert voor een reis!');
    }

    private function checkRole($sUsername) {
        if(substr($sUsername,0,1) == 'r' || substr($sUsername,0,1) == 'R') {
            return "Student";
        } else {
            return "Docent";
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
            'iban' => 'Je moet een geldig IBAN nummer ingeven.!',
            'gsm.required' => 'Je moet je GSM nummer invullen.',
            'NoodNummer1.required' => 'Je moet minstens 1 noodnummer invullen.',
            'MedischeAandoening.required' => 'Je moet aanduiden indien je een medische behandeling volgt of niet.',
        ];
    }
}


