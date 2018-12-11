<?php

namespace App\Http\Controllers;

use App\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;

class AdminZipController extends Controller
{

    /** Author: Stef Kerkhofs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm()
    {

        $aZips = Zip::all();

        //Return the view
        return view('admin.zip.zip', ['aZipData' =>$aZips]);
    }


    /** Author: Stef Kerkhofs
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createZip(Request $request)
    {

        //Check for duplication cities with equal zip numbers, if the city is a duplicate, return back to the view with the error message
        foreach(Zip::where('zip_code', $request->post('zip_code'))->get() as $tempZip)
        {
            if($tempZip->city == $request->post('city')){
                return redirect()->back()->with('alert-message', 'Fout! Deze gemeente voor deze postcode bestaat al!');
            }
        }

        //if postcode is british, belgian or dutch, insert new zip, else return error message
        if($this->isPostcode($request->post('zip_code'))){
            //Get the input
            $input = $request->all();

            //Get the validation rules
            $rules = [
                'zip_code' => 'required',
                'city' =>'required|max:50'
            ];

            //Get the messages
            $messages = $this->messages();
            //Validation
            $validator = Validator::make($input,$rules,$messages );
            //If the validation fails, return back to the view with the errors and the input you've given
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Insert new record into zips table
            Zip::insert([
                'zip_code' => $request->post('zip_code'),
                'city' => $request->post('city')
            ]);
        }
        else
        {
            return redirect()->back()->with('alert-message', "Dit is geen geldige postcode!")->withInput();
        }




        //return back to the view with the succes message
        return redirect()->back()->with('message', 'De postcode en gemeente zijn aangemaakt!');

    }

    /**Author: Joren Meynen
     * @return \Illuminate\Http\RedirectResponse
     *
     * Returns an array with custom error messages
     */
    public function deleteZip($zip_id){
        $Zip = Zip::where('zip_id', $zip_id)->firstOrFail();
        $sZipName = $Zip->zip_code . ' ' . $Zip->city;
        try{
            $Zip->delete();
        }
        catch (\Exception $e){
            return redirect(route("adminZip"))->with('alert-message', $sZipName.' : is in gebruik door reizigers en kan dus niet verwijdert worden.');
        }
        return redirect()->back()->with('message', 'Je hebt je succesvol '.$sZipName.' verwijdert.');
    }


    /**Author: Stef Kerkhofs
     * @return array
     *
     * Returns an array with custom error messages
     */
    private function messages(){
        return [
            'zip_code.required' => 'Postcode moet ingevuld zijn',
            'city.required' => 'Gemeente moet ingevuld zijn',
            'city.max' => 'Naam van de gemeente is te lang',

        ];
    }

    /**Author: Stef Kerkhofs
     * @return boolean
     *
     * Returns true when the postcode is a british, belgian or dutch. Else it returns false
     *
     */

  private function isPostcode($postcode)
    {
        $postcode = strtoupper(str_replace(' ','',$postcode));
        if(preg_match("/^[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}$/",$postcode) || preg_match("/^[0-9]{4}$/", $postcode) || preg_match("/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/", $postcode))
            return true;

        else
            return false;

    }



}

