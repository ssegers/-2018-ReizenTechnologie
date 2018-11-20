<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Storage;

class AdminPdfController extends Controller
{
    public function index(){
        $aPages = Page::where('type','!=', 'info')->get();
        return view('admin.pdf.pdf', array(
            'aPages' => $aPages,
        ));
    }

    public function updateContent(Request $request){
        if($request->get('typeSelector')=='pdf') {
            $type=$request->get('typeSelector');
            $pdf = $request->input("filepath");
            $is_visible=(bool)$request->input("Zichtbaar");
            if($pdf==null){$pdf="";}

            Page::where('page_id', $request->post('pageSelector'))->update([
                'content' => $pdf,
                'is_visible'=>$is_visible,
                'type'=>$type
            ]);

            return redirect()->back()->with('message', 'De PDF is opgeslagen');
        }
        else{
            $type=$request->get('typeSelector');
            $sContentString = $request->get('content');
            $is_visible=(bool)$request->input("Zichtbaar");
            if (strlen($sContentString) == 0){
                $sContentString = "";
            }
            Page::where('page_id', $request->post('pageSelector'))->update([
                'content' => $sContentString,
                'is_visible'=>$is_visible,
                'type'=>$type
            ]);

            return redirect()->back()->with('message', 'De pagina is aangepast');
        }

    }
    function showPdf($page_name){
        $aPdfPages= Page::where('type', 'pdf')->where('name',$page_name)->first();
        return view('guest.pdfpage', array(
            'aPdfPages' => $aPdfPages,
        ));
    }
}
