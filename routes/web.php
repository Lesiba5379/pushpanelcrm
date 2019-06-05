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


/**
 * Author: Lesiba Nxumalo
 * Desc: create routes for views
 * 
 */

// start of user ban configuration
Route::post('/getStatus','CustomsController@getStatus');
Route::post('/setStatus','CustomsController@setStatus');
Route::post('/unblockUser','CustomsController@unblockUser');
// end of user ban configuration

Route::post('/deleteEndUser','CustomsController@deleteEndUser');

Route::get('/view-campaign/{id}','CampaignController@viewCampaign');

Route::get('/edit-campaign/{id}','CustomsController@editCampaign');

Route::post('deleteCampaign','CampaignController@deleteCampaign');

Route::post('createCampaign','CampaignController@createCampaign');

//Route::post('viewCampaign/{id}','CampaignController@viewCampaign');

Route::post('/blockCampaign','CustomsController@blockCampaign');

Route::post('/unassignBeaconCampaign','CustomsController@unassignBeacon');

Route::get('/getCampaigns','CustomsController@getCampaigns');

Route::get('/TestUpdates','CustomsController@test'); 

Route::post('/assignCampaignBeacon','CustomsController@assignCampaignBeacon');

Route::get('/listCampaign','CustomsController@listCampaign');

Route::post('/assignBeacon','CustomsController@assignBeacon');

Route::get('/viewBeacon/{id}','CustomsController@loadViewBeaconView');

Route::post('/addEmployee','ManageAccounts@addEmployee');

Route::get('/viewEmployee/{id}','ManageAccounts@returnViewEmpView');

Route::get('/viewCompany/{id}','ManageAccounts@returnViewCompanyView');

Route::post('/deleteCompany','ManageAccounts@deleteCompany');

Route::post('addCompany','ManageAccounts@createCompany');

Route::get('/createCompany','ManageAccounts@returnCreateCompanyView');

Route::post('updateAccount','ManageAccounts@updateAccount');
 
Route::get('/createAdmin','ManageAccounts@returnCreateAccountView');

Route::get('/editUser/{id}','ManageAccounts@returnEditUserView');

Route::post('/deleteUser','ManageAccounts@deleteUser');

Route::get('/', function () {

    return view('welcome');
});

//Route::get('/','TestController@envFile');

Route::get('admin', function () {
    return view('admin');
});

Route::get('users', 'ManageAccounts@getAdminis');

Route::get('reg', function () {
    return view('reg');
}); 

Route::get('forgotpass', function () {
    return view('forgotpass');
});

Route::get('order', function () {
    return view('demo');
});

Route::get('/ads','CustomsController@loadAdView')
       ->name('campaign')->middleware('verified');

Route::get('/editProfile/{id}','CustomsController@editProfile');

Route::get('/beacon_view','CustomsController@addBeaconView');

Route::get('/profile','CustomsController@getProfiles');

Route::get('addBeacon','CustomsController@addBeacon');

Route::post('/blockUser','CustomsController@blockUser');

Auth::routes(['verify'=>true]);

Route::get('/home','HomeController@allProfiles');

Route::get('order','CustomsController@allBeacons');

Route::post('/deleteProfile','CustomsController@deleteProfile');

Route::post('/deleteBeacon','CustomsController@deleteBeacon');

Route::get('/home', 'HomeController@index')
           ->name('home');

Route::get('/getAllUsers','CustomsController@getAllUsers');

Route::get('/getAllProfiles','CustomsController@getAllProfiles');

Route::resource('beacon','BeaconsController');

Route::resource('profiles','ProfilesController');

Route::resource('createProfiles','CreateProfilesController');

Route::post('FirebaseMess','FirebaseController@index');

Route::post('FirebaseBeacons','FirebaseController@NewOrder');

Route::post('/FirebaseAds','FirebaseController@campaignAd');

Route::post('/createAdministrator','ManageAccounts@createAdministrator');

Route::post('/ResizeLogo','CampaignController@ResizeImage');

Route::post('FireStore','FirebaseController@FireStore');

Route::post('/assigning','CustomsController@_assignBeacon');

Route::post('/companyAssignment','CustomsController@_assignCompany');