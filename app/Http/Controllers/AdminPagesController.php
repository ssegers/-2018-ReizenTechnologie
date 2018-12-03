<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class AdminPagesController extends Controller
{
    /**
     * This function shows the pagesOverview view
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $aPages = Page::where('type','!=', 'info')->get();
        return view('admin.pdf.pagesOverview', array(
            'aPages' => $aPages,
        ));
    }

    /**
     * This function shows the editPage view
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage(Request $request){
        $pageId=$request->input('pageId');
        $aPage = Page::where('page_id',$pageId)->first();
        return view('admin.pdf.editPage', array(
            'aPage' => $aPage,
        ));
    }

    /**
     * This function creates a new page and shows the editPage view of the new page
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPage(Request $request){
        $page_name=$request->input('Name');

        Page::insert([
           'name'=>$page_name,
           'content'=>'',
           'is_visible'=>false,
           'type'=>'pdf'
        ]);
        $aPage= Page::where('name',$page_name)->first();

        return view('admin.pdf.editPage', array(
            'aPage' => $aPage,
        ))->with('message', 'De pagina is aangemaakt');
    }

    /**
     * This function deletes the related view
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePage(Request $request){

        $pageId=$request->input('pageId');

        Page::where('page_id',$pageId)->delete();
        return redirect()->back()->with('message', 'De pagina is verwijderd');
    }

    /**
     * This function updates a page
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * This function shows a page in the front-end
     *
     * @author Michiel Guilliams
     *
     * @param $page_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function showPage($page_name){
        $aPages= Page::where('type','!=','info')->where('name',$page_name)->first();
        if($aPages!=null) {
            return view('guest.contentpage', array(
                'aPages' => $aPages,
            ));
        }
        else{
            return "pagina bestaat niet";
        }
    }
}
