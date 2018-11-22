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

    public function createPage(Request $request){
        $page_name=$request->input('Name');

        Page::insert([
           'name'=>$page_name,
           'content'=>'',
           'is_visible'=>false,
           'type'=>'pdf'
        ]);

        return redirect()->back()->with('message', 'De nieuwe pagina is aangemaakt');
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

            return redirect()->back()->with('message', 'De pagina is aangepast');
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
        $aPages= Page::where('type','!=','info')->where('name',$page_name)->first();
        return view('guest.pdfpage', array(
            'aPages' => $aPages,
        ));
    }
}
