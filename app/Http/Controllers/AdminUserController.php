<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{


    /**Author: Stef Kerkhofs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm()
    {
        //gets the username for the placeholder
        $sUserName = User::where('user_id', 1)->first();
        $aRoleList = ['Reiziger', 'Begeleider', 'Organisator'];
        //returns the view with the data for placeholder
        return view('admin.users.register-user', ['sUserName' => $sUserName->username, 'aRoleList'=>$aRoleList] );
    }


    /**Author: Stef Kerkhofs
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {


        //gets the data from the view and update the table
        try
        {
            //Get the input
            $input = $request->all();

            //Get the validation rules
            $rules = [
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => "required_with:password"
            ];

            //Get the messages
            $messages = $this->messages();

            //Validation
            $validator = Validator::make($input,$rules,$messages );

            //If the validation fails, return back to the view with the errors and the input you've given
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //create a new user
            $user = new User;
            $user->username = $request->post('username');
            $user->password = bcrypt($request->post('password'));
            $select =(integer) $request->post('role');
            if($select == 0){
                $user->role = 'traveller';

            }
            else if($select == 1){
                $user->role = 'mentor';
            }
            else{
                $user->role = 'organiser';
            }
            $user->save();

            //return with success message
            return redirect()->back()->with('message', 'De gebruiker is geregistreerd!');

        }


        //when the username is a duplicate one, it returns the view with the alert message
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->back()->with('alert-message', 'Fout! De gebruikersnaam die je wilt ingeven bestaat al.');
        }

    }
    /**Author: Stef Kerkhofs
     * Returns an array with custom error messages.
     */
    private function messages(){
        return [
            'password.min' => 'Fout! Het wachtwoord is te kort.',
            'password.required_with' => 'Fout! Het paswoord moet ingevuld worden.',
            'password_confirmation.min' => 'Fout! De bevestiging van het wachtwoord is te kort.',
            'password.required_with' => 'Fout! Het paswoord moet ook nog bevestigd worden.',
            'password.same' => 'Fout! De wachtwoorden komen niet overeen.',
        ];
    }
}
