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

/* Show users per trip as an organizer */
    /* Manual organiser by username */
    Route::get('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor'); // Manual organizer
    Route::post('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor'); // Manual organize

    /* Automatic organizer by current authenticated user */
    //Route::get('user/trip/travellers', 'UserDataController@showUsersAsMentor');
    //Route::post('user/trip/travellers', 'UserDataController@showUsersAsMentor');

Route::get('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor'); // Manual organizer
Route::post('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor'); // Manual organize

Route::get('user/contact','ContactPageController@getInfo');
Route::post('user/contact', 'ContactPageController@sendMail');
//Route::get('user/trip/travellers', 'UserDataController@showUsersAsMentor');
//Route::post('user/trip/travellers', 'UserDataController@showUsersAsMentor');

route::get('user/register', 'RegisterController@form');
route::post('user/register', 'RegisterController@formPost');

//Get active trip to link to organizers
route::get('admin/linkorganisator/', 'ActiveTripOrganizerController@showActiveTrips')->name('adminLinkorganisator');
route::post('admin/linkorganisator/', 'ActiveTripOrganizerController@showLinkedOrganisators');
route::delete('admin/linkorganisator/delete', 'ActiveTripOrganizerController@removeLinkedOrganisator');
route::post('admin/linkorganisator/add', 'ActiveTripOrganizerController@addLinkedOrganisator');

route::get('admin/user/default', 'AdminUserController@createForm')->name('adminDefUser');
route::post('admin/user/default', 'AdminUserController@createUser');

Route::get('admin/info', 'AdminInfoController@getInfo')->name('adminInfo');
Route::post('admin/info', 'AdminInfoController@updateInfo');


Route::post('admin/trips', 'AdminTripController@UpdateOrCreateTrip');

Route::get('admin/trips', 'AdminTripController@getTrips')->name('adminTrips');
Route::get('admin/trips/{tripid}', 'AdminTripController@getTripByID');


Route::get('/admin/pdf', 'AdminPdfController@index')->name('adminPdf');
Route::post('/admin/pdf', 'AdminPdfController@updateContent');

Route::get('/info','AdminInfoController@showInfo')->name('info');

Route::get('/pdf/{page_name}','AdminPdfController@showPdf');

Route::get('admin/zip','AdminZipController@createForm')->name('adminZip');
Route::post('admin/zip','AdminZipController@createZip');

Route::get('admin/study', 'AdminStudyController@index')->name('adminStudy');
Route::post('admin/study/getStudies', 'AdminStudyController@getStudies');
Route::post('admin/study/getMajors', 'AdminStudyController@getMajorsByStudy');

/* Individual Traveller */
Route::get('userinfo/{sUserName}', 'UserDataController@showUserData');              //show
Route::get('userinfo/{sUserName}/edit', 'UserDataController@showUserData');         //show editable
Route::post('userinfo/{sUserName}/update', 'UserDataController@updateUserData');    //update
Route::delete('userinfo/delete', 'UserDataController@deleteUserData');              //delete

Route::get('/', function () {
    return redirect('info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
