<?php

namespace App\Http\Controllers;

use App\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminZipController extends Controller
{

    /** Author: Stef Kerkhofs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm()
    {
        //Return the view
        return view('admin.zip.zip');
    }


    /** Author: Stef Kerkhofs
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createZip(Request $request)
    {

        //Get the input
        $input = $request->all();

        //Get the validation rules
        $rules = [
            'zip_code' => 'required|numeric|min:1000|max:9999',
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

        //Check for duplication cities with equal zip numbers, if the city is a duplicate, return back to the view with the error message
        foreach(Zip::where('zip_code', $request->post('zip_code'))->get() as $tempZip)
        {
            if($tempZip->city == $request->post('city')){
                return redirect()->back()->with('alert-message', 'Deze is gemeente voor deze postcode bestaat al!');
            }
        }

        //Insert new record into zips table
        Zip::insert([
            'zip_code' => $request->post('zip_code'),
            'city' => $request->post('city')
        ]);

        //return back to the view with the succes message
        return redirect()->back()->with('message', 'De postcode en gemeente zijn aangemaakt!');

    }


    /**Author: Stef Kerkhofs
     * @return array
     *
     * Returns the custom error messages
     */
    private function messages(){
        return [
            'zip_code.required' => 'Postcode moet ingevuld zijn',
            'zip_code.numeric' => 'Postcode moet bestaan uit getallen',
            'zip_code.min' => 'Postcode is te kort',
            'zip_code.max' => 'Postcode is te lang',
            'city.required' => 'Gemeente moet ingevuld zijn',
            'city.max' => 'Naam van de gemeente is te lang',

        ];
    }



    //misschien eventueel csv kunnen uploaden van de postcodes
}

