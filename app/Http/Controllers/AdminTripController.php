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
        $aTrips = DB::table('trips')->orderBy('year')->get();
        return view('admin.trips.trips', ['aTripData' => $aTrips]);
    }

    private function CreateTrip(Request $request)
    {
        DB::table('trips')
            ->insert([
                'name' => $request->post('trip-name'),
                'is_active' => $request->input('trip-is-active', false),
                'year' => $request->post('trip-year'),
                'contact_mail' =>$request->post('trip-mail')
            ]);
    }

    function UpdateTrip(Request $request)
    {
        DB::table('trips')
            ->where('trip_id','=',$request->input('trip-id'))
            ->update([
                'name' => $request->input('trip-name'),
                'is_active' => $request->input('trip-is-active', false),
                'year' => $request->input('trip-year'),
                'contact_mail' =>$request->input('trip-mail')
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
                    'year' => $request->input('trip-year'),
                    'contact_mail' =>$request->input('trip-mail')
                ]);
        }
        else{
            //UpdateTrip($request); De functie aanroepen geeft een function not defined error
            DB::table('trips')
                ->where('trip_id','=',$request->input('trip-id'))
                ->update([
                    'name' => $request->input('trip-name'),
                    'is_active' => $request->post('trip-is-active', false),
                    'year' => $request->input('trip-year'),
                    'contact_mail' =>$request->input('trip-mail')
                ]);
        }
        return redirect('/admin/trips');
    }

}
