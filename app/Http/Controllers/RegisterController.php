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
     *
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

        return redirect('reg/form2');
    }
    public function form(){
        return view('user.register.form');
    }

    /*----------------------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------SAVE COLLECTED DATA-------------------------------*/
    /*----------------------------------------------------------------------------------------------------------------------*/
    public function SaveData($aData){
        try{
            $sFunctie = "Dummy";
            //Saving User
            $sPassword = bcrypt($aData['txtWachtwoord']);
            echo $sPassword;
            User::insert(
                [
                    'name' => $aData['txtNummer'],
                    'email' => $aData['email'],
                    'password' => $sPassword,
                    'function' => $sFunctie
                ]
            );
            //Saving traveller
            $iUserID = User::where('email',$aData['email']) ->value('id');
            if ($aData['IsStudentOrDocent'] == "2"){
                Traveller::insert(
                    [
                        'user_id' => $iUserID,
                        'trip_id' => $aData['ReisKiezen'],
                        'zip_id' => $aData['Postcode'],
                        'firstname' => $aData['firstname'],
                        'lastname' => $aData['lastname'],
                        'country' => $aData['country'],
                        'address' => $aData['address'],
                        'sex' => $aData['gender'],
                        'phone' => $aData['gsm'],
                        'emergency_phone_1' => $aData['NoodNummer1'],
                        'emergency_phone_2' => $aData['NoodNummer2'],
                        'nationality' => $aData['nationality'],
                        'birthdate' => $aData['birthdate'],
                        'birthplace' => $aData['birthplace'],
                        'medical_info' => $aData['MedischeInfo'],
                        'medical_issue' => $aData['MedischeAandoening']
                    ]
                );
            }
            else{
                Traveller::insert(
                    [
                        'user_id' => $iUserID,
                        'trip_id' => $aData['ReisKiezen'],
                        'major_id' => $aData['AfstudeerrichtingKiezen'],
                        'zip_id' => $aData['Postcode'],
                        'firstname' => $aData['firstname'],
                        'lastname' => $aData['lastname'],
                        'country' => $aData['country'],
                        'address' => $aData['address'],
                        'sex' => $aData['gender'],
                        'phone' => $aData['gsm'],
                        'emergency_phone_1' => $aData['NoodNummer1'],
                        'emergency_phone_2' => $aData['NoodNummer2'],
                        'nationality' => $aData['nationality'],
                        'birthdate' => $aData['birthdate'],
                        'birthplace' => $aData['birthplace'],
                        'medical_info' => $aData['MedischeInfo'],
                        'medical_issue' => $aData['MedischeAandoening']
                    ]
                );
            }
            //Returning completion screen
            return redirect('reg/form7');
        }
        catch (Exception $exception) {
            //If error is caught, redirect to first form
            return redirect('reg');
        }
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

