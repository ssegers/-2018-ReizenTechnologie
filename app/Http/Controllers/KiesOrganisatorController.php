<?php
namespace App\Http\Controllers;
use App\Mail\RegisterComplete;
use App\Traveller;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trip;
use App\Study;
use App\Major;
use Illuminate\Support\Facades\Mail;

class KiesOrganisatorController extends Controller
{
    /**
     * @author Daan Vandebosch
     * @return \Exception|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * Get's register session data and saves it to database.
     */
    function __construct() {
    }
    function __destruct() {
    }
    public function ShowForm(){
        return view('user.KiesOrganisator');
    }
    public function SaveData(Request $aRequest){
        $selectedTripId = $aRequest['selectedTripId'];
        $selectedUserId = $aRequest['selectedUserId'];

        DB::table('users')
            ->where('user_id', $selectedUserId)
            ->update(['votes' => 1]);
    }

    public function getOrganisators($id) {
        $organisators = Traveller::all()->where("trip_id",$id)->pluck("first_name", "last_name", "user_id");;
        echo $organisators;
        echo 'test';
        return json_encode($organisators);

    }
}


