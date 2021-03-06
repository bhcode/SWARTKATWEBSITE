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

use \App\Http\Middleware\CreateAdmin;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->middleware(CreateAdmin::class);

/*-------------------------------------------------------------------------------------
    Main, HomeController routing
---------------------------------------------------------------------------------------*/

Route::get('manage-farms', 'HomeController@farm');
Route::get('modify-users', 'HomeController@user');
Route::get('user-profile', 'HomeController@profile');
Route::get('userguide', 'UserGuideController@index');

/*-------------------------------------------------------------------------------------
    Routes for changing user settings
---------------------------------------------------------------------------------------*/
Route::get('user-settings', 'SettingsController@UserSettings')
    ->name('user-settings');
Route::post('user-settings', 'SettingsController@ChangeUserSettings')
    ->name('user-settings');

/*-------------------------------------------------------------------------------------
    Routes for modifying farms
---------------------------------------------------------------------------------------*/
Route::get('create-farm/{type}', 'FarmController@CreateFarm')
    ->name('create-farm');
Route::post('create-farm/{type}', 'FarmController@AddNewFarm')
    ->name('create-farm');

Route::get('modify-existing-farm/{farmid}', 'FarmController@ModifyFarm')
    ->name('modify-existing-farm');
Route::post('modify-existing-farm/{farmid}', 'FarmController@AddModifyFarm')
    ->name('modify-existing-farm');

Route::get('delete-farm/{farmid}', 'FarmController@DeleteFarm')
    ->name('delete-farm');

/*-------------------------------------------------------------------------------------
    Routes for modifying user roles
---------------------------------------------------------------------------------------*/
Route::post('modify-users', 'HomeController@roleChange');

/*-------------------------------------------------------------------------------------
    Routes for viewing data and details
---------------------------------------------------------------------------------------*/
Route::get('farm-details/{farmid}', 'FarmController@FarmDetails')
    ->name('farm-details');
Route::get('archive', 'DataController@WeeklyDisplay')
    ->name('archive');
Route::post('archive', 'DataController@PostWeeklyDisplay')
    ->name('archive');

/*--------------------------------------------------------------------------------------
    Routes for modifying data
---------------------------------------------------------------------------------------*/
Route::get('weekly-data', 'DataController@WeeklyData')
    ->name('weekly-data');
Route::post('weekly-data', 'DataController@PostWeeklyData')
    ->name('weekly-data');



