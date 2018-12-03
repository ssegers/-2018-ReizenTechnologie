<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class AdminInfoController extends Controller
{
    /**
     * This function enables the CKEditor to upload a image
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return string
     */
    public function uploadImage(Request $request) {
        $CKEditor = Input::get('CKEditor');
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path() .'/photos/shares', $filename);
                $url = '/photos/shares/' . $filename;
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }

    /**
     * This function fills the editor with its saved content
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInfo(){
        $oPageContent = Page::where('name', 'Info')->first();
        return view('admin.info.info', array(
            'oPageContent' => $oPageContent,
        ));
    }

    /**
     * This function updates the content of the infoPage
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(Request $request){
        $sContentString = $request->post('content');
        if (strlen($sContentString) == 0){
            $sContentString = "";
        }
        Page::where('name', 'Info')->update(['content' => $sContentString]);
        return redirect()->back()->with('message', 'De info pagina is aangepast');
    }

    /**
     * This function shows the infoPage in the front-end
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInfo(){
        $oContent=Page::where('name', 'Info')->first();
        return view('guest.infopage', array(
            'oContent' => $oContent,
        ));
    }
}
