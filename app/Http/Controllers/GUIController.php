<?php

namespace App\Http\Controllers;

use App\Calculation;
use App\Comment;
use App\Farm;
use App\FarmSupplement;
use App\Http\Controllers\Auth\RegisterController;
use App\Paddock;
use App\Label;
use App\UserFarm;
use App\Weeklydata;
use Aws\CloudFront\Exception\Exception;
use Caffeinated\Shinobi\Middleware\UserHasRole;
use App\User;
use Illuminate\Http\Request;
use \Caffeinated\Shinobi\Models\Role;
use \Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GUIController extends Controller
{
    public function FindUser(Request $request){
        //users must use email and password to try login, just like the website
        $email = $request->input('email');
        $password = $request->input('password');

        //use Auth to attempt a login with the provided user email and password
        if (Auth::attempt(['email' => $email, 'password' => $password]))
            $userExists = True;
        else
            $userExists = False;

        //return json response
        $info = array($userExists);
        return \response()->json($info);
    }

    public function CreateUser(Request $request){
        //hoping this will work, ripped from the register controller
        return User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
    }

    public function CreateModFarm(Request $request){

        $findFarm = Farm::find($request->input('id'));

        if(count($findFarm) == 0) {
            //if farm doesnt exist make a new one
            $farm = new Farm();
            $farm->name = $request->input('name');
            $farm->area = $request->input('area');
            $farm-> save();
            return \response()->json("Farm Created!");
        }
        else {
            $farm = Farm::find($request->input('id'));
            if($request->input('name') != null)
                $farm->name = $request->input('name');
            if( $request->input('area')!= null)
                $farm->area = $request->input('area');
            $farm->save();
            $info = array($farm);
            return \response()->json($info);
        }
    }

    public function AssignRole(Request $request){
        //use this to assign roles, pass in the supplied user email!
        //1 = admin, 2 = guest, 3 = user
        $useremail = $request->input('email');
        $role = $request->input('role');
        $roleid = 0;

        //confirm role id
        if($role == 0)// admin
            $roleid = 1;
        if($role == 1)// user
            $roleid = 3;
        if( $role == 2)// guest
            $roleid = 2;

        //get user and sync the role
        $user =  User::where('email', $useremail)->first();
        $user->syncRoles([$roleid]);

        $info = array($user, $roleid);
        return \response()->json($info);
    }



    public function GetFarmName(Request $request)
    {
        //pass in farmid to get farm name
        $farmid = $request->farmid;
        $farm = Farm::find($farmid);
        $farmname = $farm->name;
        return \response()->json($farmname);
    }

    public function GetFarmArea(Request $request)
    {
        //pass in farmid to get farm area
        $farmid = $request->farmid;
        $farm = Farm::find($farmid);
        $farmname = $farm->area;
        return \response()->json($farmname);
    }

    public function GetCows(Request $request)
    {
        //get cows from farm sups with id
        $farmid = $request->farmid;
        if (count(FarmSupplement::all()) == 0) {
            $cows = "No farm supplement data found";
        } else {
            $farmsup = DB::table('farm_supplements')->select('cows')->where('farmid', '=', $farmid)->orderBy('id')->first();
        }
        return \response()->json($farmsup);
    }

    public function AssignFarm(Request $request)
    {
        $farmid = $request->input('farmid');
        $useremail = $request->input('email');
        $user =  User::where('email', $useremail)->first();
        $userid = $user-> id;

        if(UserFarm::where('userid',$userid)->first() == null) {
            //if the user id is not assigned to a farm, make new farm
            //then set the farm's user id to a farm
            $assignFarm = new UserFarm();
            $assignFarm->userid = $userid;
            $assignFarm->farmid = $farmid;
            $assignFarm->save();
        }
        else{
            $assignFarm = UserFarm::where('userid',$userid)->first();
            $assignFarm->farmid = $farmid;
            $assignFarm->save();
        }
    }

    public function ModifyUser(Request $request)
    {
        //this is really bad :^) we need to make it a post + add security
        //pass in user email, must be done!
        $useremail = $request->input('email');
        $user =  User::where('email', $useremail)->first();

        //pass in a newname param to change user's name
        if ($request->input('newname') != null) {
            $user->name = $request->input('newname');
        }

        //pass in a newemail param to change user's email
        if ($request->input('newemail') != null) {
            $user->email = $request->input('newemail');
        }

        //pass in a newpassword param to change user's password
        if (($request->input('newpassword') != null)) {
            $user->password = bcrypt($request->input('newpassword'));
        }

        $user->save();
    }

    //get the user farm
    public function UserFarm(Request $request){
        //pass in the user email
        $useremail = $request->input('email');
        $user =  User::where('email', $useremail)->first();
        $userid = $user->id;

        //find user's farm
        $userfarm = UserFarm::where('userid','=',$userid)->first();

        //get farm details
        if($userfarm != null) {
            $farmid = $userfarm->farmid;
            $farmname = Farm::find($farmid)->name;
            $area = Farm::find($farmid)->area;
        }

        if($userfarm == null) {
            $info = array(0, 'None', 0);
            return \response()->json($info);
        }
        else {
            $info = array($farmid, $farmname, $area);
            return \response()->json($info);
        }
    }

    //get user role
    public function UserRole(Request $request){
        //pass in the user email
        $useremail = $request->input('email');
        $user =  User::where('email', $useremail)->first();
        $userid = $user->id;
        $userrole = DB::table('role_user')->where('user_id','=', $userid)->first();

        //get user's role
        if($userrole == null) {
            $role = 2;
        }
        else {
            if ($userrole->role_id == 1) //admin
                $role = 0;
            else if ($userrole->role_id == 3) //user
                $role = 1;
            else
                $role = 2; //guest
        }
        return \response()->json($role);
    }

    public function GetConsData(Request $request){
        $fulldate = $request->fulldate;
        $data =  DB::table('weeklydatas')->select('farmid','data')->where('sdate','=', $fulldate)->get();
        return \response()->json($data);
    }

    public function  GetFarmDates (Request $request){
        //input is user email, return distinct of each date
        //pass in the user email
        $userid = $request->input('userid');

        //find user's farm
        $farm = UserFarm::where('userid',$userid)->first();
        $farmid = $farm->farmid;

        if($farmid!= null) {
            try {
                $dates = DB::table('weeklydatas')->select('sdate')->where('farmid', '=', $farmid)->distinct()->get();
            } catch (\Exception $e) {
                $dates = $e->getMessage();
            }
            return \response()->json($dates);
        }
    }

}
