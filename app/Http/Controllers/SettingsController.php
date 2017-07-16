<?php

namespace App\Http\Controllers;

use App\Farm;
use App\UserFarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserSettings()
    {
        $success = 0;
        //$farms = Farm::pluck('id','name'); //Pluck method retrieves all of the values for a given key
        $farms = Farm::all();
        return view('manage.user-setting',compact('success','farms'));
    }
    //change settings
    public function ChangeUserSettings(Request $request)
    {
        //basic validation
        $this->validate($request,[
            'NewEmail'=>'max:255|unique:users,email',
            'CurrentPassword'=>'required',
            'NewPassword' => 'confirmed'
        ]);
        //extra logic
        $oldPW = $request->input('CurrentPassword');
        $hashedPW = Auth::user()->getAuthPassword();
        $user = Auth::user();

        $success = 0;

        if(Hash::Check($oldPW, $hashedPW)) {
            if ($request->input('NewEmail') != null) {
                $user->email = $request->input('NewEmail');
            }
            if ($request->input('ConfirmPassword') != null) {
                if (($request->input('NewPassword')) !== $oldPW)
                    $user->password = bcrypt($request->input('NewPassword'));
                else
                    $warning = 'New Password must be different than current password.';
            }
            if($request->input('NewFarm') != null)
            {
                //only assigning first farm in table
                $farms = Farm::find($request->input('NewFarm'));

                if(UserFarm::where('userid', Auth::id())->exists())
                {
                    $userfarm = UserFarm::where('userid', Auth::id())->first();
                    $userfarm -> farmid = $farms->id;
                    $userfarm -> save();
                }
                else{
                    $userfarm = new UserFarm();
                    $userfarm -> farmid = $farms->id;
                    $userfarm -> userid = Auth::id();
                    $userfarm -> save();
                }
            }
            $success = 1;
        }
        else{
            $warning = "Please enter a correct current password.";
        }

        $user->save();

        $data = array();
        if (isset($warning))
            $data = array_add($data, "warning", $warning);

        $farms = Farm::all();

        return view('manage.user-setting', compact('success','data','farms'));
    }
}
