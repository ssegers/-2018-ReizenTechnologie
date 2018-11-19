<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class AdminInfoController extends Controller
{
    public function uploadImage(Request $request) {
        $CKEditor = Input::get('CKEditor');
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path() .'/photos/shares', $filename);
                $url = 'http://ictprojects.test/photos/shares/' . $filename;
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
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
