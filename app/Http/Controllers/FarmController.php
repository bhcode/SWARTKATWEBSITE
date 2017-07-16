<?php

namespace App\Http\Controllers;

use App\Farm;
use App\User;
use App\UserFarm;
use Illuminate\Http\Request;

class FarmController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CreateFarm($type)
    {
        $success = 0;

        return view('manage.create-farm', compact('success', 'type'));
    }

    public function AddNewFarm($type, Request $request)
    {
        $this->validate($request, [
            'NewFarmName' => 'required',
            'NewFarmArea'=> 'required|numeric'
        ]);

        $farm = new Farm();
        $farm -> name = $request->input('NewFarmName');
        $farm -> area = $request->input('NewFarmArea');
        $farm-> save();

        $success = 1;

        return view('manage.create-farm',  compact('success', 'type'));
    }


    public function ModifyFarm($farmid)
    {
        $success = 0;
        $farm = Farm::find($farmid);
        return view('manage.modify-existing-farm', compact('success','farm'));
    }

    public function AddModifyFarm($farmid, Request $request)
    {
        $success = 1;
        $farm = Farm::find($farmid);
        if ($request->input('ModFarmName') != null) {
            $farm->name = $request->input('ModFarmName');
        }
        if($request->input('ModFarmArea') != null) {
            $farm->area = $request->input('ModFarmArea');
        }
        $farm->save();
        return view('manage.modify-existing-farm', compact('success','farm'));
    }

    public function DeleteFarm($farmid)
    {
        $farm = Farm::find($farmid);
        $farmname = $farm->name;
        //also remove all userfarm records
        $farm -> delete();
        return view('manage.delete-farm',compact('farmname'));
    }

    public function FarmDetails($farmid)
    {
        $farm = Farm::find($farmid);
        $userfarms = UserFarm::where('farmid',$farmid)->get();
        $usernames = array();
        foreach($userfarms as $uf)
        {
            $user = User::where('id','=',$uf->userid)->first();
            $username = $user->name;
            array_push($usernames, $username);
        }
        return view('data.farm-details',compact('farm','usernames'));
    }
}
