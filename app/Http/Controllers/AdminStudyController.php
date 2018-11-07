<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminStudyController extends Controller
{

    /**
     * This function returns a view with all data from majors and studies
     *
     * @author Yoeri op't Roodt
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $aMajors = Major::get();
        $aStudies = Study::get();

        return view('admin.studies.studies', array(
            'aMajors' => $aMajors,
            'aStudies' => $aStudies,
        ));
    }

    /**
     * This method returns all studies in a given major
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     * @return mixed
     */
    public function getStudiesByMajor(Request $request) {
        $iMajorId = $request->post('major-id');
        $aStudies = Study::where('major_id', $iMajorId)->get();

        return $aStudies;
    }
}
