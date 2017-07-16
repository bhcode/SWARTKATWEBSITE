<?php

namespace App\Providers;

use App\Farm;
use App\RowLabel;
use App\UserFarm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    static function getrole($userid)
    {
        $userrole = DB::table('role_user')->where('user_id','=', $userid)->first();
        if($userrole != null) {
            $userroleid = $userrole->role_id;
            $role = DB::table('roles')->where('id','=', $userroleid)->first();
            $roleid = $role->name;
            return ucfirst($roleid);
        }
        else{
            return "None";
        }
    }

    static function getfarmid($userid)
    {
        if(count(UserFarm::all()) != 0) {
            $userfarm = UserFarm::where('userid', $userid)->first();
            if($userfarm != null) {
                $farmid = $userfarm -> farmid;
                $farm =  Farm::find($farmid);
                if($farm != null) {
                    return ($farm->name);
                }
                else{
                    return "None";
                }
            }
            else {
                return "None";
            }
        }
        else{
            return "None";
        }

    }

    static function getfarmname($farmid)
    {
            $farm = Farm::find($farmid);
                if($farm != null) {
                    return ($farm->name);
                }
                else {
                    return "None";
                }
    }

    static function explodeData($data, $start, $end)
    {
        $data = str_replace("[","", $data);
        $data = str_replace("]","", $data);
        $labels = ["Crop area", "Crop area Available", "Area Grazed (avg for last 2 pickups)", "Pre Grazing Cover", "Average Cover (kgDM/ha)", "Growth Rate (kgDM/ha/day)", "Predicted Growth Rate (kgDM/ha/day)", "Area shut-up for supplements", "Milked into Vat",
                                            "NOT milked into Vat", "Dry cows (On farm)", "Dry cows (Off farm)", "Kg Liveweight/cow", "Average MS/day (last 2 pickups)", "KgMS month to date", "Avg SCC (000) for last 2 pickups", "Protein Fat", "Ratio Calf Milk (litres)",
                                        "Grain (kgDM)", "Palm kernel (kgDM)", "Silage(kgDM)", "Balage (kgDM)", "Molasses (kgDM)", "Straw (kgDM)", "Hay (kgDM)", "Other (kgDM)", "Total Consumption (kgDM/cow/day)", "Area N applied (ha)", "Rate per hectare (kgN/ha)", "Total N applied(kgN/ha)", "Total N applied Year To Date(kgN/ha)", "Deaths",
                                            "Deaths to date", "Cows Sold", "Cows Sold to date", "Two Year Dairy Heifers", "One Year Dairy Heifers", "AB Dairy Heifer Calves", "All Other Calves", "Bulls", "Other", "Two Year Dairy Heifers", "One Year Dairy Heifers", "AB Dairy Heifer Calves", "All Other Calves", "Bulls", "Other"];
        $datas = explode(",",$data);
        $datalist = array();
        for($i=$start; $i<$end; $i++)
        {
            $datalist[$labels[$i]] = $datas[$i];
        }
        return $datalist;
    }
}
