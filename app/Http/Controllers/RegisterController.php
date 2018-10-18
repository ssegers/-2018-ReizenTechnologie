<?php
namespace App\Http\Controllers;
use App\Traveller;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $aData["radioGeslacht"] = $aRequest->post('radioGeslacht');
        $aData["txtNationaliteit"] = $aRequest->post('txtNationaliteit');
        $aData["dateGeboorte"] = $aRequest->post('dateGeboorte');
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
        $aData["radioMedisch"] = $aRequest->post('radioMedisch');
        $aData["txtMedischDetail"] = $aRequest->post('txtMedischDetail');

        $this->SaveData($aData);

        return redirect('welcome');
    }

    public function form(){
        return view('user.Form.form');
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
        User::insert(
            [
                'name' => $aData["txtStudentnummer"],
                'password' => 'abc',
                'role' => $sFunctie
            ]
        );

        $iUserID = User::where('name',$aData['txtStudentnummer']) ->value('user_id');

        //Saving traveller
        Travellers::insert(
            [
                'user_id' => $iUserID,
                'trip_id' => $aData['dropReis'],
                'zip_id' => $aData['dropGemeente'],
                'first_name' => $aData['txtVooraam'],
                'last_name' => $aData['txtNaam'],
                'country' => $aData['txtLand'],
                'address' => $aData['txtAdres'],
                'gender' => $aData['radioGeslacht'],
                'phone' => $aData['txtGsm'],
                'emergency_phone_1' => $aData['txtNoodnummer1'],
                'emergency_phone_2' => $aData['txtNoodnummer2'],
                'nationality' => $aData['txtNationaliteit'],
                'birthdate' => $aData['birthplace'],
                'birthplace' => "Geboorteplaats",
                'medical_info' => $aData['radioMedisch'],
                'medical_issue' => $aData['txtMedischDetail'],
                'email' => $aData['txtEmail'],
                'major_id' => $aData['dropOpleiding']
            ]
        );
        //BANK STUDY


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


