<?php

use App\Farm;
use App\UserFarm;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Label;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| Access via '/api/{}'
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/foo', function () {
    return 'Testing... Testing';
});

/*-------------------------------------------------------------------------------------
    Routing for GUI needs
---------------------------------------------------------------------------------------*/

Route::get('/finduser', array(
    'as' => 'finduser',
    'uses' => 'GUIController@FindUser'
));

Route::get('/createuser', array(
    'as' => 'createuser',
    'uses' => 'GUIController@CreateUser'
));

Route::get('/getusersfarm', array(
    'as' => 'getusersfarm',
    'uses' => 'GUIController@UserFarm'
));

Route::get('/assignrole', array(
    'as' => 'assignrole',
    'uses' => 'GUIController@AssignRole'
));

Route::get('/getusers', function (Request $request){
    $users = User::all();
    return \response()->json($users);
});

Route::get('/getfarms',  function (Request $request){
    $farms = Farm::all();
    return \response()->json($farms);
});


Route::get('/getuserfarms', function (Request $request){
    $farms = UserFarm::all();
    return \response()->json($farms);
});

Route::get('/getuserrole', array(
    'as' => 'getuserroles',
    'uses' => 'GUIController@UserRole'
));

Route::get('/getfarmname', array(
    'as' => 'getfarmname',
    'uses' => 'GUIController@GetFarmName'
));

Route::get('/getarea', array(
    'as' => 'getarea',
    'uses' => 'GUIController@GetFarmArea'
));

Route::get('/getcows', array(
    'as' => 'getcows',
    'uses' => 'GUIController@GetCows'
));

Route::get('/getfarmcount',function (Request $request){
    $farmcount = Farm::count();
    return \response()->json($farmcount);
});


Route::get('/createmodfarm', array(
    'as' => 'createmodfarm',
    'uses' => 'GUIController@CreateModFarm'
));

Route::get('/assignfarm', array(
    'as' => 'assignfarm',
    'uses' => 'GUIController@AssignFarm'
));

Route::get('/modifyuser', array(
    'as' => 'modifyuser',
    'uses' => 'GUIController@ModifyUser'
));

Route::get('/getuploaddates', function (Request $request){
    $data =  DB::table('weeklydatas')->select('sdate')->distinct()->get();
    return \response()->json($data);
});

/*-------------------------------------------------------------------------------------
    Routing to download database information
---------------------------------------------------------------------------------------*/

Route::get('/getdata', array(
    'as' => 'getdata',
    'uses' => 'GUIController@GetConsData'
));

Route::get('/getfarmdates', array(
    'as' => 'getfarmdates',
    'uses' => 'GUIController@GetFarmDates'
));

/*-------------------------------------------------------------------------------------
    Routing for Calculation and Label db entries
---------------------------------------------------------------------------------------*/

Route::get('/getlabels',  function (Request $request){
    $labels = Label::all();
    return \response()->json($labels);
});

Route::get('/getcalcs', function (Request $request){
    $calcs = Calculation::all();
    return \response()->json($calcs);
});
