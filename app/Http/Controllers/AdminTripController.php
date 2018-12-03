<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Trip;

class AdminTripController extends Controller
{
    //GET::/admin/trips
    function getTrips()
    {
        //$aTrips = DB::table('trips')->orderBy('year')->get();
        $aTrips = Trip::orderby('year', 'desc')->get();
        return view('admin.trips.trips', ['aTripData' => $aTrips]);
    }

    private function CreateTrip(Request $request)
    {
        DB::table('trips')
            ->insert([
                'name' => $request->post('trip-name'),
                'is_active' => $request->input('trip-is-active', false),
                'year' => $request->post('trip-year'),
                'contact_mail' =>$request->post('trip-mail'),
                'price'=>$request->post('trip-price')
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
                'contact_mail' =>$request->input('trip-mail'),
                'price'=>$request->post('trip-price')
            ]);
    }

    //POST::/admin/trips/
    function UpdateOrCreateTrip(Request $request)
    {
        if($request->post('trip-id') == -1)
        {
            $oTrip = new Trip();
            $oTrip->name = $request->input('trip-name');
            $oTrip->is_active = $request->input('trip-is-active', false);
            $oTrip->year = $request->input('trip-year');
            $oTrip->contact_mail = $request->input('trip-mail');
            $oTrip->price = $request->post('trip-price');
            $oTrip->save();
        }
        else{
            //UpdateTrip($request); De functie aanroepen geeft een function not defined error
            $oTrip = Trip::find($request->input('trip-id'));
            $oTrip->name = $request->input('trip-name');
            $oTrip->is_active = $request->input('trip-is-active', false);
            $oTrip->year = $request->input('trip-year');
            $oTrip->contact_mail = $request->input('trip-mail');
            $oTrip->price = $request->post('trip-price');
            $oTrip->save();
        }
        return redirect('/admin/trips');
    }

}
