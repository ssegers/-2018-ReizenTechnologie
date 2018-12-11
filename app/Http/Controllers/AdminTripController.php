<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Trip;
use Illuminate\Support\Facades\Validator;

class AdminTripController extends Controller
{
    function getTrip(Request $request)
    {
        //geef data aan modal door
    }

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
        $validator = Validator::make($request->all(), [
            'trip-name'     => 'required',
            'trip-year'     => 'required',
            'trip-price'    => 'required',
            'trip-mail'     => 'email|nullable',
        ],$this->messages());

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

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

    /**
     * @author Joren Meynen
     * @return array
     */
    public function messages()
    {
        return [
            'trip-name.required'    => 'U heeft de naam van de reis niet ingevuld.',
            'trip-year.required'    => 'U heeft het jaar van de reis niet ingevuld.',
            'trip-price.required'   => 'U heeft de prijs van de reis niet ingevuld.',
            'trip-mail.email'       => 'U heeft geen geldig email ingevuld.',
        ];
    }
}
