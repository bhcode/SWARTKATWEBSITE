<?php

use App\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this is the weekly labels
        $labels = [ "Honey (kg)", "Honey to Date (kg)" , "Avg Honey Per Hive (kg)", "Royal Honey (kg)", "Avg Royal Honey Per Hive (kg)",
            "Royal Honey to Date (kg)","Beeswax (kg)","Feeding","Honey Store","Pollen Store","Honey Feed","Pollen Feed","Ener-H-Plus","HFCS-55",
            "Vita Feed Gold","Pollen Patty","Living Conditions","Hive Condition","Temper","Odor","Population","Laying Pattern",
            "Area Information","Total Area (m^2)","Total Frames","Total Frames Unused","Death Information","Deaths","Deaths to Date",
            "Disease Information","Diseased Hives","Hives Treated","Replacement Hives","Bees Bought (kg)","Conditions","Avg Temperature","New Queens"];

        foreach($labels as $l)
        {
            $newEntry = new Label();
            $newEntry->label = $l;
            $newEntry->description = "Weekly";
            $newEntry->save();
        }

        //monthly below
    }
}
