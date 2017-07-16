<?php

namespace App\Http\Controllers;
use App\Calculation;
use App\Comment;
use App\Farm;
use App\FarmSupplement;
use App\Paddock;
use App\Weeklydata;
use App\Label;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function InsertData(Request $request)
    {
        //get farm data from the Request
        $farmid = $request -> input("farmid");
        $sdate = $request -> input("sdate");
        $data = $request -> input("data");

        $duplicate = DB::table('weeklydatas')->where([['farmid', '=' , $farmid], ['sdate', '=' ,$sdate]])->first();

        //save farm data to the database table 'weekly data'
        if($duplicate == null) { //if there is no similar record
            $weeklydata = new Weeklydata();
            $weeklydata->farmid = $farmid;
            $weeklydata->sdate = $sdate;
            $weeklydata->data = $data;
            $weeklydata->save();
        }
        else{ //if there is a similar record
            $duplicatedata = $duplicate->data;
            if($duplicatedata != $data)//if the existing record is different from the new one
            {
                $duplicate->data = $data;
                $duplicate->save();
            }
        }
    }

    public function InsertLabel(Request $request)
    {
        //get row labels
        $row = $request -> input("row");
        $label = $request -> input("label");

        $duplicate = DB::table('labels')->where('row', $row)->first();

        //save row label data
        if($duplicate == null) {
            $rowlabel = new Label();
            $rowlabel->row = $row;
            $rowlabel->label = $label;
            $rowlabel->save();
        }
    }

    public function InsertCalculations(Request $request)
    {
        //get calculations
        $row = $request -> input("row");
        $formula = $request -> input("formula");

        $duplicate = DB::table('calculations')->where('row', $row)->first();

        //save calculations to db
        if($duplicate == null) {
            $calc = new Calculation();
            $calc->row = $row;
            $calc->formula = $formula;
            $calc->save();
        }
    }

    public function InsertPaddocks(Request $request)
    {
        //get paddock data
        $farmid = $request -> input("farmid");
        $sdate = $request -> input("sdate");
        $paddockid = $request -> input("paddockid");
        $crop = $request -> input("crop");
        $size = $request -> input("size");

        $duplicate = DB::table('paddocks')->where([['farmid', '=' , $farmid], ['sdate', '=' ,$sdate]])->first();

        //save paddock data
        if($duplicate == null) {
            $paddock = new Paddock();
            $paddock->farmid = $farmid;
            $paddock->sdate = $sdate;
            $paddock->paddockid = $paddockid;
            $paddock->crop = $crop;
            $paddock->size = $size;
            $paddock->save();
        }
    }

    public function InsertFarms(Request $request)
    {
        //get farm data
        $name = $request -> input("name");
        $area = $request -> input("area");

        //save farm info
        $farm = new Farm();
        $farm -> name = $name;
        $farm -> area = $area;
        $farm-> save();
    }

    public function InsertComments(Request $request)
    {
        //get comment data
        $farmid = $request-> input("farmid");
        $sdate = $request-> input("sdate");
        $category = $request-> input("category");
        $description = $request-> input("description");

        $duplicate = DB::table('comments')->where([['farmid', '=' , $farmid], ['sdate', '=' ,$sdate],['category', '=', $category]])->first();

        //save comment data
        if($duplicate == null) {
            $comment = new Comment();
            $comment->farmid = $farmid;
            $comment->sdate = $sdate;
            $comment->category = $category;
            $comment->description = $description;
            $comment->save();
        }
    }

    public function InsertFarmSupplements(Request $request)
    {
        //get data about farm supplements
        $farmid = $request-> input("farmid");
        $sdate = $request-> input("sdate");
        $cows = $request-> input("cows");
        $supplements = $request-> input("supplements");

        $duplicate = DB::table('farm_supplements')->where([['farmid', '=' , $farmid], ['sdate', '=' ,$sdate]])->first();

        //save farm supplement data
        if($duplicate == null) {
            $farmsupplement = new FarmSupplement();
            $farmsupplement->farmid = $farmid;
            $farmsupplement->sdate = $sdate;
            $farmsupplement->cows = $cows;
            $farmsupplement->supplements = $supplements;
            $farmsupplement->save();
        }
    }
}
