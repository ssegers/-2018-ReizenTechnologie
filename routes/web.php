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

Route::prefix('user')->group(function () {
    Route::get('{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor');
    Route::post('{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor'); // Manual organizer

    Route::get('contact','ContactPageController@getInfo')->name('contact');
    Route::post('contact', 'ContactPageController@sendMail');

    Route::prefix('form')->group(function() {
        route::get('step-1', 'RegisterController@step1');
        route::post('step-1', 'RegisterController@step1Post');

        route::get('step-2', 'RegisterController@step2');
        route::post('step-2', 'RegisterController@step2Post');

        route::get('step-3', 'RegisterController@step3');
        route::post('step-3', 'RegisterController@step3Post');

        route::get('step-4', 'RegisterController@step4');
        route::post('step-4', 'RegisterController@step4Post');
    });

});

Route::prefix('userinfo')->group(function() {
    Route::get('{sUserName}', 'UserDataController@showUserData');
    Route::get('{sUserName}/edit', 'UserDataController@showUserData');         //show editable
    Route::post('{sUserName}/cascade', 'UserDataController@GetMajorsByStudy');
    Route::post('{sUserName}/update', 'UserDataController@updateUserData');    //update
    Route::delete('delete', 'UserDataController@deleteUserData');              //delete
});

Route::prefix('admin')->group(function() {
    Route::prefix('linkorganisator')->group(function() {
        route::get('/', 'ActiveTripOrganizerController@showActiveTrips')->name('adminLinkorganisator');
        route::post('/', 'ActiveTripOrganizerController@showLinkedOrganisators');
        route::delete('/delete', 'ActiveTripOrganizerController@removeLinkedOrganisator');
        route::post('/add', 'ActiveTripOrganizerController@addLinkedOrganisator');
    });

    route::get('user/default', 'AdminUserController@createForm')->name('adminDefUser');
    route::post('user/default', 'AdminUserController@createUser');

    Route::get('info', 'AdminInfoController@getInfo')->name('adminInfo');
    Route::post('info', 'AdminInfoController@updateInfo');
    Route::post('upload_image','AdminInfoController@uploadImage')->name('upload');

    Route::post('trips', 'AdminTripController@UpdateOrCreateTrip');
    Route::get('trips', 'AdminTripController@getTrips')->name('adminTrips');
    Route::get('trips/{tripid}', 'AdminTripController@getTripByID');

    Route::get('pdf', 'AdminPdfController@index')->name('adminPdf');
    Route::post('updatePdf', 'AdminPdfController@updateContent');
    Route::post('createPage', 'AdminPdfController@createPage');

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

Route::get('/info','AdminInfoController@showInfo')->name('info');
Route::get('/pdf/{page_name}','AdminPdfController@showPdf');
Route::get('/', function () {
    return redirect('info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
