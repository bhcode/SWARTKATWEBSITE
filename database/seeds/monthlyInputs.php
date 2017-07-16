<?php

use App\Label;
use Illuminate\Database\Seeder;

class monthlyInputs extends Seeder
{
    /**
     * Run the database seeds.
     * this is the FIRST FORM of the monthly document, which apparently is the monthly inputs.
     * @return void
     */
    public function run()
    {
        //
        $labels = [
            "Land and Feed up to date", "MINDA up to date","Youngstock weights received from grazier and entered into MINDA","Updated reproduction KPI's - see Reproduction Tab",
            "Pond Level (%)","Dairy diary Manual Up-to-date	","Completed Vehicle/machinery maintenanc","Completed Cowshed Maintenance","Annual leave , Hours worked etc. monthly staff roster completed",
            "Timesheets filled out and sent through to office admin and supervisor","If Serious harm injury occurred notified OM immediately","Updated hazards list","Hazardous Substances (Agri Chemicals) Register",
            "Recorded all Workplace  Near Misses","Constantly checked the ES soil moisture website nearest you","Avoided objectionable odour","Checked out fail safe mechanism","Checked storage pond/weeping wall effluent consistency",
            "Calibrated pods","Recorded all applications","Checked all fittings to minimize any chances of blowouts","Read and understood the farms effluent resource consent","Adhered to Fortuna’s  effluent guidelines",
            "All fertilizer applications recorded and sent to OM","All Resource Consent commitments abided by","Animal wellfare maintained to FGL standards","Water Usage Chart filled out","Basic tool requirements",
            "Smoke detectors/fire extinguishers","How many non 4 titted cows in the milking herd","Herd BW of numbered cows","Herd PW of numbered cows"];

        foreach($labels as $l)
        {
            $newEntry = new Label();
            $newEntry->label = $l;
            $newEntry->description = "Monthly";
            $newEntry->save();
        }
    }
}
