<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class AdminPagesController extends Controller
{
    public function index(){
        $aPages = Page::where('type','!=', 'info')->get();
        return view('admin.pdf.pagesOverview', array(
            'aPages' => $aPages,
        ));
    }

    public function editPage(Request $request){
        $pageId=$request->input('pageId');
        $aPage = Page::where('page_id',$pageId)->first();
        return view('admin.pdf.editPage', array(
            'aPage' => $aPage,
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
        $pageId=$request->input('pageId');
        if($request->get('typeSelector')=='pdf') {
            $type=$request->get('typeSelector');
            $pdf = $request->input("filepath");
            $is_visible=(bool)$request->input("Zichtbaar");
            if($pdf==null){$pdf="";}

            Page::where('page_id', $pageId)->update([
                'content' => $pdf,
                'is_visible'=>$is_visible,
                'type'=>$type
            ]);

            return redirect()->route("adminPages")->with('message', 'De pagina is aangepast');
        }
        else{
            $type=$request->get('typeSelector');
            $sContentString = $request->get('content');
            $is_visible=(bool)$request->input("Zichtbaar");
            if (strlen($sContentString) == 0){
                $sContentString = "";
            }
            Page::where('page_id', $pageId)->update([
                'content' => $sContentString,
                'is_visible'=>$is_visible,
                'type'=>$type
            ]);

            return redirect()->route("adminPages")->with('message', 'De pagina is aangepast');
        }

    }
    function showPdf($page_name){
        $aPages= Page::where('type','!=','info')->where('name',$page_name)->first();
        return view('guest.contentpage', array(
            'aPages' => $aPages,
        ));
    }
}
