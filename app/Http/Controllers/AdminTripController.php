<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Trip;
use Illuminate\Support\Facades\Validator;
class AdminTripController extends Controller
{
    //GET::/admin/trips
    /**
     * @author Robin Machiels
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getTrips()
    {
        //$aTrips = DB::table('trips')->orderBy('year')->get();
        $aTrips = Trip::orderby('year', 'desc')->get();
        return view('admin.trips.trips', ['aTripData' => $aTrips]);
    }
    //POST::/admin/trips/

    /**
     * @author Robin Machiels
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function UpdateOrCreateTrip(Request $request)
    {
        /*$validator = Validator::make($request->all(), [
            'trip-name'     => 'required',
            'trip-year'     => 'required',
            'trip-price'    => 'required',
            'trip-mail'     => 'email|nullable',
        ],$this->messages());
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }*/
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
            $oTrip = Trip::find($request->input('trip-id'));
            $oTrip->name = $request->input('trip-name');
            $oTrip->is_active = $request->input('trip-is-active', false);
            $oTrip->year = $request->input('trip-year');
            $oTrip->contact_mail = $request->input('trip-mail');
            $oTrip->price = $request->post('trip-price');
            $oTrip->save();
        }
        return redirect('/admin/trips')->with('message', 'De reis is succesvol opgeslagen');
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