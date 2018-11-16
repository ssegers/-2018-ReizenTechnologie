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

Route::get('/', function () {
    return view('welcome');
});

/* Show users per trip as an organizer */
Route::get('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor');
Route::post('user/{sUserName}/trip/travellers', 'UserDataController@showUsersAsMentor');
//Route::get('user/trip/travellers', 'UserDataController@showUsersAsMentor');
//Route::post('user/trip/travellers', 'UserDataController@showUsersAsMentor');

route::get('user/Form/form', 'RegisterController@form');
route::post('user/Form/form', 'RegisterController@formPost');

route::get('user/Form/step-1', 'RegisterController@step1');
route::post('user/Form/step-1', 'RegisterController@step1Post');

route::get('user/Form/step-2', 'RegisterController@step2');
route::post('user/Form/step-2', 'RegisterController@step2Post');

route::get('user/Form/step-3', 'RegisterController@step3');
route::post('user/Form/step-3', 'RegisterController@step3Post');

route::get('user/Form/step-4', 'RegisterController@step4');
route::post('user/Form/step-4', 'RegisterController@step4Post');

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

Route::get('admin/organisator', 'KiesOrganisatorController@ShowForm');
Route::post('admin/organisator', 'KiesOrganisatorController@ShowForm');
Route::get('admin/get/organisators/{id}', 'KiesOrganisatorController@getOrganisators');


Route::get('/info','AdminInfoController@showInfo')->name('info');
/* Individual Traveller */
Route::get('userinfo/{sUserName}', 'UserDataController@showUserData');              //show
Route::get('userinfo/{sUserName}/edit', 'UserDataController@showUserData');         //edit
Route::post('userinfo/{sUserName}/update', 'UserDataController@updateUserData');    //update
Route::get('userinfo/{sUserName}/delete', 'UserDataController@deleteUserData');     //delete

Route::get('/', function () {
    return redirect('info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
