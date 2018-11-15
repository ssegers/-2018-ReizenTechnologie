<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminStudyController extends Controller {
    /**
     * This function returns a view with all data from majors and studies
     *
     * @author Yoeri op't Roodt
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
//        $aMajors = Major::get();
        $aStudies = Study::get();
        $iStudyCount = Study::get()->count();

        return view('admin.studies.studies', array(
//            'aMajors' => $aMajors,
            'aStudies' => $aStudies,
            'iStudyCount' => $iStudyCount,
        ));
    }

    /**
     * This method returns all majors in a given study
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function getMajorsByStudy(Request $request) {
        $iStudyId = $request->post('study-id');
        $aMajors = Major::where('study_id', $iStudyId)->get();

        return response()->json([
            'aStudies' => $aMajors,
        ]);
    }

    /**
     * This method saves the given study
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveStudy(Request $request) {
        $validator = Validator::make($request->all(), array(
            'study_name' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ]);
        }

        Study::insert([
            'study_name' => $request->post('study-name'),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * This method saves the given major
     *
     * @author Yoeri op' Roodt
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMajor(Request $request) {
        $validator = Validator::make($request->all(), array(
            'study_id' => 'required',
            'major_name' => 'required',
        ));


        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ]);
        }

        Major::insert([
            'study_id' => $request->post('study-id'),
            'major_name' => $request->post('major-name'),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
