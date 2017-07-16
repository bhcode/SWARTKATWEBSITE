<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Label;
use App\UserFarm;
use App\WeeklyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function WeeklyData()
    {
        $userid = Auth::id();
        $success = 0;
        if(!UserFarm::where('userid','=',$userid)->exists()) {
            //dont allow data input if user does not have farm!
        }
        $weeklydatas=Label::where("description","Weekly")->get();
        return view("data.weekly-data",compact("weeklydatas","success"));
    }

    public function PostWeeklyData(Request $request)
    {
        $success = 0;
        $userid = Auth::id();
        if(UserFarm::where('userid','=', Auth::id())->exists())
        {
            $userfarm = UserFarm::where('userid',$userid)->first();
            $farmid = $userfarm->farmid;
            $entryidcount = 1;
            if(WeeklyData::where('farmid','=',$farmid)->exists())
            {
                $recentWeeklyRecord = WeeklyData::where('farmid','=',$farmid)->latest();
                $entryidcount = ($recentWeeklyRecord->first()->entryid) + 1;
            }

            $input = $request->all();

            foreach($input as $key => $value){
                if($value != null && $key != '_token') {
                    $newWeekly = new WeeklyData();
                    $newWeekly->farmid = $farmid;
                    $newWeekly->entryid = $entryidcount;
                    $newWeekly->label = $key;
                    $newWeekly->data = $value;
                    $newWeekly->save();
                }
            }

            $success = 1;
        }
        else{
            $success = 2;
        }

        $weeklydatas=Label::where("description","Weekly")->get();

        return view("data.weekly-data",compact("weeklydatas","success"));
    }

    public function WeeklyDisplay ()
    {
        $farms = Farm::all();
        $datatype = "all";
        $weeklydata = WeeklyData::all();
        $input = false;
        return view("data.archive.archive", compact("farms", "input", "weeklydata", "datatype"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function PostWeeklyDisplay (Request $request)
    {
        $farms = Farm::all();
        //curently only weeklydata
        $weeklydata = WeeklyData::all();
        $datatype = "all";

        if($request->datatype == "week")
        {
            $datatype = "week";
        }
        if($request->datatype == "month")
        {
            $datatype = "month";
        }

        if($request->farmid !== 'All') {
            if (!DB::table('weekly_datas')->where('farmid', $request->farmid)->exists()) {
                //$data = emptyArray();
                $weeklydata = WeeklyData::all();
            } else {
                $weeklydata = DB::table('weekly_datas')->select('farmid', 'entryid', 'created_at', 'label', 'data')->where('farmid', $request->farmid)->distinct()->get();
            }
        }

        $checkDate = Input::get('datesubmit'); //checks what button was pressed
        if(isset($checkDate))
        {
            foreach ($weeklydata as $key => $d) {
                if ($d->created_at <= $request->startdate) {
                    $d->category = "Under";
                    unset($weeklydata[$key]);
                }
                if ($d->created_at >= $request->enddate) {
                    $d->category = "Over";
                    unset($weeklydata[$key]);
                }
            }
        }

        $input = false;
        return view("data.archive.archive", compact("farms", "input", "weeklydata", "datatype"));
    }
}
