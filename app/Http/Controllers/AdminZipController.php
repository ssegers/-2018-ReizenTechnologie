<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminZipController extends Controller
{

    public function createForm(){

        return view('admin.zip.zip');
    }



    public function createZip(Request $request){

        if(!is_int($request)){
            return redirect()->back()->with('alert-message', 'Fout! een postcode moet uit cijfers bestaan');
        }
        else{
            try{
                
            }
             catch(\Illuminate\Database\QueryException $e){
                 return redirect()->back()->with('alert-message', 'Fout! De postcode die je wilt ingeven bestaat al.');
            }
        }
    }
}
