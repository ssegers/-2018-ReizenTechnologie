<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminStudyController extends Controller {
    /**
     * This function shows the view
     *
     * @author Yoeri op't Roodt
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.studies.studies');
    }

    /**
     * This method returns the list of studies
     *
     * @author Yoeri op't Roodt
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudies() {
        $aStudies = Study::get();

        return response()->json([
            'aStudies' => $aStudies,
        ]);
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
        $iStudyId = $request->post('study_id', 1);
        $aMajors = Major::where('study_id', $iStudyId)->get();

        return response()->json([
            'aMajors' => $aMajors,
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
    public function addStudy(Request $request) {
        $validator = \Validator::make($request->all(), array(
            'study_name' => 'required|unique:studies',
        ), $this->errors());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all(),
            ]);
        }

        Study::insert([
            'study_name' => $request->post('study_name'),
        ]);

        return response()->json([
            'success' => true,
            'messages' => [
                'De richting is toegevoegt',
            ]
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
    public function addMajor(Request $request) {
        $validator = \Validator::make($request->all(), array(
            'study_id' => 'required',
            'major_name' => 'required|unique:majors',
        ), $this->errors());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messages' => $validator->errors()->all(),
            ]);
        }

        Major::insert([
            'study_id' => $request->post('study_id'),
            'major_name' => $request->post('major_name'),
        ]);

        return response()->json([
            'success' => true,
            'messages' => [
                'De afstudeerrichting is toegevoegt',
            ]
        ]);
    }

    private function errors() {
        return [
            'study_id.required' => 'Selecteer een richting',
            'study_name.required' => 'De richting kan niet leeg zijn',
            'study_name.unique' => 'Deze richting bestaat al',

            'major_name.required' => 'De afstudeerrichting kan niet leeg zijn',
            'major_name.unique' => 'Deze afstudeerrichting bestaat al',
        ];
    }
}
