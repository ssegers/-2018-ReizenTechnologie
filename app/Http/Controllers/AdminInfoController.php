<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class AdminInfoController extends Controller
{
    public function getInfo(){
        /*if (DB::table('users')->where('id', Auth::id())->value('function') !== 'admin')
        {
            return redirect('/');
        }*/
        $oPageContent = Page::where('name', 'Info')->first();
        return view('admin.info.info', array(
            'oPageContent' => $oPageContent,
        ));
    }
    public function updateInfo(Request $request){
        /*if (DB::table('users')->where('id', Auth::id())->value('function') !== 'admin')
        {
            return redirect('/');
        }*/
        $sContentString = $request->post('content');
        if (strlen($sContentString) == 0){
            $sContentString = "";
        }
        Page::where('name', 'Info')->update(['content' => $sContentString]);
        return redirect()->back()->with('message', 'De info pagina is aangepast');
    }
}
