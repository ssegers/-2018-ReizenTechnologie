<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminTripController extends Controller
{
    //GET::/admin/trips
    function getTrips()
    {
        $aTrips = DB::table('trips')->get();
        return view('admin.trips.trips', ['aTripData' => $aTrips]);

    }

    //GET::/admin/trips/{id}
    function getTripByID($id)
    {
        $oTrip = DB::table('trips')->where('trip_id', '=', $id)->first();
        return view('admin.trips.singleTrip', ['oTrip' =>$oTrip]); //moet naar een popup gaan, view target is niet juist
    }

    private function CreateTrip(Request $request)
    {
        DB::table('trips')
            ->insert([
                'name' => $request->post('trip-name'),
                'is_active' => $request->input('trip-is-active', false),
                'year' => $request->post('trip-year')
            ]);
    }

    function UpdateTrip(Request $request)
    {
        DB::table('trips')
            ->where('trip_id','=',$request->input('trip-id'))
            ->update([
                'name' => $request->input('trip-name'),
                'is_active' => $request->input('trip-is-active', false),
                'year' => $request->input('trip-year')
            ]);
    }

    //POST::/admin/trips/
    function UpdateOrCreateTrip(Request $request)
    {
        if($request->post('trip-id') == -1)
        {
            //CreateTrip($request); De functie aanroepen geeft een function not defined error
            DB::table('trips')
                ->insert([
                    'name' => $request->input('trip-name'),
                    'is_active' => $request->input('trip-is-active', false),
                    'year' => $request->input('trip-year')
                ]);
        }
        else{
            //UpdateTrip($request); De functie aanroepen geeft een function not defined error
            DB::table('trips')
                ->where('trip_id','=',$request->input('trip-id'))
                ->update([
                    'name' => $request->input('trip-name'),
                    'is_active' => $request->post('trip-is-active', false),
                    'year' => $request->input('trip-year')
                ]);
        }
        return redirect('/admin/trips');
    }






}
