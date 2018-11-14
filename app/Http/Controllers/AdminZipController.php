<?php

namespace App\Http\Controllers;

use App\Zip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminZipController extends Controller
{

    public function createForm()
    {

        return view('admin.zip.zip');
    }


    public function createZip(Request $request)
    {

            try {
                $zip = new Zip;
                $zip->zip_code =$request->post('zip_code');
                $zip->city = $request->post('city');
                $zip->save();

                return redirect()->back()->with('message', 'De postcode is toegevoegd!');

            }
            catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('alert-message', 'Fout! De postcode die je wilt ingeven bestaat al.');
            }
    }
}


