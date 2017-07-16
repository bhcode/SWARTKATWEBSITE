<?php

namespace App\Http\Controllers;

use App\Farm;
use App\FileUpload;
use App\User;
use App\UserFarm;
use Barryvdh\Debugbar\Facade;
use \Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Integer;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function farm()
    {
        $users = User::all();
        $farms = Farm::all();
        $success = 0;
        return view('home.manage-farms', compact('users','success','farms'));
    }

    public function farmChange(Request $request)
    {
        $farmid = $request->input('farmid');
        $userid = $request->input('userid');

        if(UserFarm::where('userid',$userid) == null) {
            $assignFarm = new UserFarm();
            $assignFarm->userid = $userid;
            $assignFarm->farmid = $farmid;
            $assignFarm->save();
        }
        else{
            $assignFarm = UserFarm::find($userid);
            $assignFarm->farmid = $farmid;
            $assignFarm->save();
        }

        $users = User::all();
        $farms = Farm::all();
        $success = 1;

        return view('home.manage-farms', compact('users','success','farms'));
    }

    public function user()
    {
        $users = User::all();
        $roles = Role::all();
        $success = 0;
        return view('home.modify-users', compact('users','roles', 'success'));
    }

    public function roleChange(Request $request)
    {
        $userid = $request->input('userid');
        $roleid = $request->input('roleid');

        $user =  User::where('id', $userid)->first();
        $user->syncRoles([$roleid]);

        //$users = User::all()->except((\Auth::id()));
        $users = User::all();
        $roles = Role::all();
        $success = 1;

        return view('home.modify-users', compact('users','roles','success'));
    }

    public function Profile()
    {
        $userfarm = UserFarm::where('userid','=', Auth::id())->first();
        if($userfarm == null)
        {
            $farm = "None";
        }
        else{
            $findfarm = Farm::where('id', ($userfarm->farmid))->first();
            $farm = $findfarm->name;
        }

        return view('home.user-profile',compact('farm'));
    }
}
