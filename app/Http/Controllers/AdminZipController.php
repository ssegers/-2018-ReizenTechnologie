<?php

namespace App\Http\Controllers;

use App\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminZipController extends Controller
{

    /**Stef Kerkhofs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm()
    {

        return view('admin.zip.zip');
    }


    /** Stef Kerkhofs
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createZip(Request $request)
    {


        $input = $request->all();
        $rules = [
            'zip_code' => 'required|numeric|min:1000|max:9999',
            'city' =>'required|max:50'
            ];
        $messages = $this->messages();

        $validator = Validator::make($input,$rules,$messages );

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        return var_dump($validator);
        Zip::insert([
            'zip_code' => $request->post('zip_code'),
            'city' => $request->post('city')
        ]);

        return redirect()->back()->with('message', 'De postcode en gemeente zijn aangemaakt!');

         }


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


