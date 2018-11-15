<?php
namespace App\Http\Controllers;
use App\Mail\RegisterComplete;
use App\Traveller;
use App\User;
use App\Trip;
use App\Study;
use App\Major;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
    /*----------------------------------------------------------------------------------------------------------------------*/
    /*---------------------------------------------------------------------------FORM---------------------------------------*/
    /*----------------------------------------------------------------------------------------------------------------------*/
    public function formPost(Request $aRequest){
        //Eerste scherm
        $aData["dropReis"] = $aRequest->post('dropReis');
        $aData["txtStudentnummer"] = $aRequest->post('txtStudentnummer');
        $aData["dropOpleiding"] = $aRequest->post('dropOpleiding');
        $aData["dropAfstudeerrichting"] = $aRequest->post('dropAfstudeerrichting');

        //Tweede scherm
        $aData["txtNaam"] = $aRequest->post('txtNaam');
        $aData["txtVoornaam"] = $aRequest->post('txtVoornaam');
        $aData["radioGeslacht"] = $aRequest->post('gender');
        $aData["txtNationaliteit"] = $aRequest->post('txtNationaliteit');
        $aData["dateGeboorte"] = $aRequest->post('dateGeboorte');
        $aData["txtGeboorteplaats"] = $aRequest->post('txtGeboorteplaats');
        $aData["txtAdres"] = $aRequest->post('txtAdres');
        $aData["txtLand"] = $aRequest->post('txtLand');
        $aData["dropGemeente"] = $aRequest->post('dropGemeente');
        $aData["txtBank"] = $aRequest->post('txtBank');

        //Derde scherm
        $aData["txtGsm"] = $aRequest->post('txtGsm');
        $aData["txtNoodnummer1"] = $aRequest->post('txtNoodnummer1');
        $aData["txtNoodnummer2"] = $aRequest->post('txtNoodnummer2');
        $aData["txtEmail"] = $aRequest->post('txtEmail');

        //Vierde scherm
        $aData["radioMedisch"] = $aRequest->post('check');
        $aData["txtMedischDetail"] = $aRequest->post('txtMedisch');

        $this->SaveData($aData);

//        echo Traveller::all();
//        echo User::all();
        $aRequest->session()->flash('info', 'Om uw registratie te voltooien moet u inliggen met de gegevens die via email zijn verzonden');

        return redirect('info')->with('info', 'Om uw registratie te voltooien moet u inliggen met de gegevens die via email zijn verzonden');
    }

    public function form(){
        $aTrips = Trip::where('is_active', true)->orderBy('name')->pluck('name');
        $aOpleidingen = Study::pluck('study_name','study_id');
        $aAfstudeerrichtingen = DB::table('majors')->get();
        foreach($aAfstudeerrichtingen as $oAfstudeerrichting){
            $aMajors[$oAfstudeerrichting->study_id][] = $oAfstudeerrichting->major_name;
        }

        //Major::pluck('major_name');

        return view('user.Form.form', ['aTrips'=>$aTrips, 'aOpleidingen'=>$aOpleidingen, 'aMajors'=>$aMajors]);
    }

    /*----------------------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------SAVE COLLECTED DATA-------------------------------*/
    /*----------------------------------------------------------------------------------------------------------------------*/
    public function SaveData($aData){
        if($aData["txtStudentnummer"][0] = "r"){
            $sFunctie = "Student";
        }
        else{
            $sFunctie = "Begeleider";
        }
        //Saving user
        $password = $this->randomPassword();
        User::insert(
            [
                'username' => $aData["txtStudentnummer"],
                'password' => bcrypt($password),
                'role' => $sFunctie
            ]
        );

        $iUserID = User::where('username',$aData['txtStudentnummer']) ->value('user_id');
        //Saving traveller
        Traveller::insert(
            [
                'user_id' => $iUserID,
                'trip_id' => $aData['dropReis'],
                //'zip_id' => $aData['dropGemeente'],
                'zip_id' => 1,
                'first_name' => $aData['txtVoornaam'],
                'last_name' => $aData['txtNaam'],
                'country' => $aData['txtLand'],
                'address' => $aData['txtAdres'],
                'gender' => $aData['radioGeslacht'],
                'phone' => $aData['txtGsm'],
                'emergency_phone_1' => $aData['txtNoodnummer1'],
                'emergency_phone_2' => $aData['txtNoodnummer2'],
                'nationality' => $aData['txtNationaliteit'],
                'birthdate' => $aData['dateGeboorte'],
                'birthplace' => $aData['txtGeboorteplaats'],
                'medical_info' => $aData['txtMedischDetail'],
                'iban' => $aData['txtBank'],
                'medical_issue' => $aData['radioMedisch'],
                'email' => $aData['txtEmail'],
                'major_id' => $aData["dropOpleiding"]
            ]
        );
        $this->sendMail($aData['joren.meynen@telenet.be'],'Fagolini', 'poep');
        $this->sendMail($aData['txtEmail'],$aData['txtNaam'],$password);
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

    /*----------------------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------------Collection of error messages----------------*/
    /*----------------------------------------------------------------------------------------------------------------------*/
    public function messages()
    {
        return [
            'txtNummer.required' => 'Je Studenten-/docentennummer moet ingevuld worden.',
            'txtWachtwoord.required'  => 'Je moet een wachtwoord invullen.',
            'txtWachtwoord_confirmation.required'  => 'Je moet je wachtwoord bevestigen.',
            'txtWachtwoord.min' => 'Je wachtwoord moet minsten uit 8 tekens bestaan.',
            'txtWachtwoord.confirmed' => 'Je opgegeven paswoorden komen niet met elkaar overeen.',
            'radio.required' => 'Geef aan als je een student/docent bent of niet.',
            'txtEmail.required' => 'Vul je email adres in.',
            'txtEmail.email' => 'Het ingevulde email adres is niet geldig.',
            'txtEmail.unique' => 'Het ingevulde email adres is al in gebruik.',
            'txtNummer.unique' => 'Het ingevulde Studenten-/docentennummer is al in gebruik.',
            'ReisKiezen.required' => 'Je moet een reis kiezen.',
            'AfstudeerrichtingKiezen.required' => 'Je moet een afstudeerrichting kiezen.',
            'lastname.required' => 'Je moet je achternaam invullen.',
            'firstname.required' => 'Je moet je voornaam invullen.',
            'gender.required' => 'Je moet een geslacht kiezen.',
            'birthdate.required' => 'Je moet je geboorte datum ingeven.',
            'birthdate.date_format' => 'De waarde die je hebt ingevuld hebt bij geboorte datum in ongeldig',
            'birthplace.required' => 'Je moet je geboorte plaats ingeven.',
            'nationality.required' => 'je moet je nationaliteit opgeven.',
            'Postcode.required' => 'Je moet je postcode ingeven.',
            'country.required' => 'Je moet je land ingeven',
            'address.required' => 'Je moet je adres ingeven.',
            'gsm.required' => 'Je moet je GSM nummer invullen.',
            'NoodNummer1.required' => 'Je moet minstens 1 noodnummer invullen.',
            'MedischeAandoening.required' => 'Je moet aanduiden indien je een medische behandeling volgt of niet.',
        ];
    }
}


