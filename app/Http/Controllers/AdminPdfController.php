<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Storage;

class AdminPdfController extends Controller
{
    public function index(){
        $aPages = Page::where('type', 'pdf')->get();
        return view('admin.pdf.pdf', array(
            'aPages' => $aPages,
        ));
    }

    public function updateContent(Request $request){
        $pdf = $request->file("pdf")->getClientOriginalName();

        $request->file("pdf")->storeAs('public/upload',$pdf);

        Page::where('page_id', $request->post('pageSelector'))->update([
            'content' => $pdf,
        ]);

        return redirect()->back()->with('message', 'De PDF is opgeslagen');
    }
    function showPdf($page_name){
        $aPdfPages= Page::where('type', 'pdf')->where('name',$page_name)->first();
        return view('guest.pdfpage', array(
            'aPdfPages' => $aPdfPages,
        ));
    }
}
