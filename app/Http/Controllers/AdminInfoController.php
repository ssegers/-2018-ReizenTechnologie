<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function showInfo(){
        $oContent=Page::where('name', 'Info')->first();
        return view('guest.infopage', array(
            'oContent' => $oContent,
        ));
    }
}
