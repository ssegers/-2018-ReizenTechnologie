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
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::prefix('linkorganisator')->group(function() {
            route::get('/', 'ActiveTripOrganizerController@showActiveTrips')->name('adminLinkorganisator');
            route::post('/', 'ActiveTripOrganizerController@showLinkedOrganisators');
            route::delete('/delete', 'ActiveTripOrganizerController@removeLinkedOrganisator');
            route::post('/add', 'ActiveTripOrganizerController@addLinkedOrganisator');

        });

        route::get('user/register', 'AdminUserController@createForm')->name('adminRegUser');
        route::post('user/register', 'AdminUserController@createUser');

        Route::get('info', 'AdminInfoController@getInfo')->name('adminInfo');
        Route::post('info', 'AdminInfoController@updateInfo');
        Route::post('upload_image','AdminInfoController@uploadImage')->name('upload');

        Route::post('trips', 'AdminTripController@UpdateOrCreateTrip');
        Route::get('trips', 'AdminTripController@getTrips')->name('adminTrips');
        Route::get('trips/{tripid}', 'AdminTripController@getTripByID');

        Route::get('overviewPages', 'AdminPagesController@index')->name('adminPages');
        Route::post('editPage', 'AdminPagesController@editPage');
        Route::post('deletePage', 'AdminPagesController@deletePage');
        Route::post('updateContent', 'AdminPagesController@updateContent');
        Route::post('createPage', 'AdminPagesController@createPage');

        Route::get('zip','AdminZipController@createForm')->name('adminZip');
        Route::post('zip','AdminZipController@createZip');
        Route::delete('zip/{zip_id}','AdminZipController@deleteZip')->name('deleteZip');

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
Route::middleware(['auth','guide'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('trip/{trip?}', 'UserDataController@showUsersAsMentor')->name("filter");
        Route::post('trip/{trip?}', 'UserDataController@showUsersAsMentor');

        Route::get('payment/{trip?}','PaymentsOverviewController@showTable')->name('payments');
        Route::post('AddPayment/{traveller_id}', 'PaymentsOverviewController@addPayment');
        Route::post('payment', 'PaymentsOverviewController@sendMail');

        Route::get('updatemail','MailController@getUpdateForm')->name('updatemail');
        Route::post('updatemail', 'MailController@sendUpdateMail');
        Route::post('updatemail/getEmail', 'MailController@getContactPersonByTripId');
    });
    //IndividualTraveller profile
    Route::prefix('userinfo')->group(function() {
        Route::get('{sUserName}', 'UserDataController@showUserData');
        Route::get('{sUserName}/edit', 'UserDataController@showUserData');
        Route::post('{sUserName}/update', 'UserDataController@updateUserData');
        Route::delete('{sUserName}/delete', 'UserDataController@deleteUserData')->name('user.destroy');
    });

    //hotels
    Route::prefix('hotel')->group(function() {
        Route::get('/listhotels', 'HotelRoomController@getHotelsPerTripOrganizer')->name("listhotelsOrganizer");
        Route::post('/listhotels', 'HotelRoomController@getHotelsPerTripOrganizer');
        Route::post('/deleteHotel', 'HotelRoomController@deleteHotel');
        Route::post('/connectHotelToTrip', 'HotelRoomController@connectHotelToTrip');
        Route::post('/createHotel', 'HotelRoomController@createHotel');

        Route::get('/listrooms/{hotel_id}/{hotel_name}', 'HotelRoomController@getRoomsOrganisator');
        Route::post('/listrooms/{hotel_id}/{hotel_name}', 'HotelRoomController@getRoomsOrganisator');

        Route::post('/addRoom', 'HotelRoomController@addHotelRoom');
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
Route::middleware(['auth','traveller'])->group(function () {
    Route::prefix('user')->group(function () {
        //hotels
        Route::prefix('hotel')->group(function() {
            Route::get('/listhotels', 'HotelRoomController@getHotelsPerTripUser')->name("listhotelsUser");

            Route::get('/listrooms/{hotel_id}/{hotel_name}', 'HotelRoomController@getRoomsUser');
            Route::post('/listrooms/{hotel_id}/{hotel_name}', 'HotelRoomController@getRoomsUser');

        });
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
            route::get('step-0', 'RegisterController@step0')->name('registerTripMessage');
            route::post('step-0', 'RegisterController@step0Post');
            route::get('step-1', 'RegisterController@step1')->name('registerTrip');
            route::post('step-1', 'RegisterController@step1Post');

            route::get('step-2', 'RegisterController@step2');
            route::post('step-2', 'RegisterController@step2Post');
            route::post('step-add-zip', 'RegisterController@createZip');

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
        Route::get('', 'UserDataController@showUserData')->name('profile');
        Route::get('/edit', 'UserDataController@showUserData');
        Route::post('{sUserName}/update', 'UserDataController@updateUserData');
    });
    Route::get('/logout','AuthController@logout')->name("logout");

    Route::prefix('hotel')->group(function() {
        Route::post('/chooseRoom', 'HotelRoomController@chooseRoom');
        Route::post('/leaveRoom', 'HotelRoomController@leaveRoom');
    });
});


/*
 * -------------------------------------------------------------------------------
 * ---------------------------   Always available   ------------------------------
 * -------------------------------------------------------------------------------
 */
Route::prefix('user')->group(function () {
    Route::get('payment','PaymentsOverviewController@showTable')->name('payments');
    Route::post('AddPayment', 'PaymentsOverviewController@addPayment');
    Route::post('payment', 'PaymentsOverviewController@sendMail');
    Route::get('contact','ContactPageController@getInfo')->name('contact');
    Route::post('contact', 'ContactPageController@sendMail');
    Route::get('refresh_captcha', 'ContactPageController@refreshCaptcha')->name('refresh_captcha');

});
Route::get('/', function () {
    return redirect()->route('info');
});

Route::get('/info','AdminInfoController@showInfo')->name('info');
Route::get('/page/{page_name}','AdminPagesController@showPage');

// Password reset link request routes...
Route::get('password/setmail', 'AuthController@ShowEmail');
Route::post('password/setmail', 'AuthController@ShowEmailPost');

// Password reset routes...
Route::get('password/resetpassword/{token}', 'AuthController@ShowResetPassword');
Route::post('password/resetpassword', 'AuthController@ResetPassword');

//--------------------------------------END---------------------------------------






Auth::routes();
//login routes
Route::post('/auth', 'AuthController@login');
Route::get('/log','AuthController@showView')->name("log");


//API calls
Route::post('cascade', 'UserDataController@GetMajorsByStudy');



//Route::get('/home', 'HomeController@index')->name('home');
