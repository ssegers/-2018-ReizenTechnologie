<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * -------------------------------------------------------------------------------
 * -------------------------------   ADMIN PANEL   -------------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth','admin'])->group(function () {

    Route::prefix('admin')->group(function() {
        Route::get('/',function(){
            return redirect()->route('adminInfo');
        });
        Route::prefix('linkorganisator')->group(function() {
            route::get('/', 'ActiveTripOrganizerController@showActiveTrips')->name('adminLinkorganisator');
            route::post('/', 'ActiveTripOrganizerController@showLinkedOrganisators');
            route::delete('/delete', 'ActiveTripOrganizerController@removeLinkedOrganisator');
            route::post('/add', 'ActiveTripOrganizerController@addLinkedOrganisator');

        });

        route::get('user/register', 'AdminUserController@createForm')->name('adminRegUser');
        route::post('user/register', 'AdminUserController@createUser');

        Route::get('/info','AdminInfoController@showInfo')->name('info');
        Route::get('/page/{page_name}','AdminPagesController@showPdf');

        Route::get('info', 'AdminInfoController@getInfo')->name('adminInfo');
        Route::post('info', 'AdminInfoController@updateInfo');
        Route::post('upload_image','AdminInfoController@uploadImage')->name('upload');

        Route::post('trips', 'AdminTripController@UpdateOrCreateTrip');
        Route::get('trips', 'AdminTripController@getTrips')->name('adminTrips');
        Route::get('trips/{tripid}', 'AdminTripController@getTripByID');

        Route::get('overviewPages', 'AdminPagesController@index')->name('adminPages');
        Route::post('editPage', 'AdminPagesController@editPage');
        Route::post('verwijderPage', 'AdminPagesController@verwijderPage');
        Route::post('updateContent', 'AdminPagesController@updateContent');
        Route::post('createPage', 'AdminPagesController@createPage');

        Route::get('zip','AdminZipController@createForm')->name('adminZip');
        Route::post('zip','AdminZipController@createZip');

        Route::prefix('study')->group(function() {
            Route::get('/', 'AdminStudyController@index')->name('adminStudy');
            Route::post('getStudies', 'AdminStudyController@getStudies');
            Route::post('getMajors', 'AdminStudyController@getMajorsByStudy');
            Route::post('addStudy', 'AdminStudyController@addStudy');
            Route::post('addMajor', 'AdminStudyController@addMajor');
        });
    });

});
//--------------------------------------END---------------------------------------


/*
 * -------------------------------------------------------------------------------
 * -------------------------------   Organisator   -------------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth','organisator'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor');
        Route::post('{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor');
        Route::get('updatemail','MailController@getUpdateForm')->name('updatemail');
        Route::post('updatemail', 'MailController@sendUpdateMail');
    });
});
//--------------------------------------END---------------------------------------


/*
 * -------------------------------------------------------------------------------
 * ----------------------------------   Guide   ----------------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth','guide'])->group(function () {

});
//--------------------------------------END---------------------------------------


/*
 * -------------------------------------------------------------------------------
 * -------------------------------   Traveller   ---------------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth.traveller'])->group(function () {
    Route::prefix('user')->group(function () {

    });
});
//--------------------------------------END---------------------------------------

/*
 * -------------------------------------------------------------------------------
 * ---------------------------------   Guest   -----------------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth','guest'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::prefix('form')->group(function() {
            route::get('step-1', 'RegisterController@step1')->name('registerTrip');
            route::post('step-1', 'RegisterController@step1Post');

            route::get('step-2', 'RegisterController@step2');
            route::post('step-2', 'RegisterController@step2Post');

            route::get('step-3', 'RegisterController@step3');
            route::post('step-3', 'RegisterController@step3Post');
        });
    });
});
//--------------------------------------END---------------------------------------


/*
 * -------------------------------------------------------------------------------
 * --------------------------   Generally logged in   ----------------------------
 * -------------------------------------------------------------------------------
 */
Route::middleware(['auth','loggedIn'])->group(function () {
//User profile
    Route::prefix('profile')->group(function() {
        Route::get('', 'UserProfileController@showUserData')->name('profile');
        Route::get('/edit', 'UserProfileController@showUserData');
        Route::post('{sUserName}/update', 'UserProfileController@updateUserData');
    });
    Route::get('/logout','AuthController@logout')->name("logout");
});


/*
 * -------------------------------------------------------------------------------
 * ---------------------------   Always available   ------------------------------
 * -------------------------------------------------------------------------------
 */
Route::prefix('user')->group(function () {
    Route::get('payment','PaymentsOverviewController@showTable')->name('payments');
    Route::get('contact','ContactPageController@getInfo')->name('contact');
    Route::post('contact', 'ContactPageController@sendMail');

});
Route::get('/', function () {
    return redirect()->route('info');
});
Route::get('info', 'AdminInfocontroller@showInfo')->name('info');
//--------------------------------------END---------------------------------------

//IndividualTraveller profile
Route::prefix('userinfo')->group(function() {
    Route::get('{sUserName}', 'UserDataController@showUserData');
    Route::get('{sUserName}/edit', 'UserDataController@showUserData');
    Route::post('{sUserName}/update', 'UserDataController@updateUserData');
    Route::delete('{sUserName}/delete', 'UserDataController@deleteUserData')->name('user.destroy');
});



Auth::routes();
//login routes
Route::post('/auth', 'AuthController@login');
Route::get('/log','AuthController@showView')->name("log");


//WIP
Route::get('/listhotels', 'HotelRoomController@getHotelsPerTrip');
Route::get('/listrooms/{hotels_per_trip_id}', 'HotelRoomController@getRooms');
Route::get('/listtravellers/{room_hotel_trip_id}', 'HotelRoomController@getTravellers');
//EndWIP

//API calls
Route::post('cascade', 'UserDataController@GetMajorsByStudy');



//Route::get('/home', 'HomeController@index')->name('home');
