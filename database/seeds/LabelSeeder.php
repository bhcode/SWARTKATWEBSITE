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
        $labels = ["Week Ending","Crop Area", "Crop area Available","Area Grazed (Average for last two pickups)","Pre Grazing Cover","Post Grazing Cover(Ave for week)","Average Cover(kgDM/ha)","Growth Rate(kgDM per ha per day)",
             "Predicted Growth Rate(kgDM per ha per day)","Area shut-up for supplements","Total cows wintered","Milked into Vat","NOT milked into Vat", "% not in vat", "% cows calved", "Dry cows(On farm)",
             "Dry cows(Off farm)","Kg Liveweight per cow", "Average MS per day (last two pickups)","December DailyTarget","% to target",
             "KgMS month to date", "Avg SCC (000) for last two pickups","Protein Fat Ratio","Calf Milk (litres)",
             "Grain (kgDM)", "Palm kernel (kgDM)", "Silage(kgDM)","Balage (kgDM)","Molasses (kgDM)","Straw(kgDM)","Hay (kgDM)","Other (kgDM)", "Total Consumption(kgDM per cow per day)",
             "Area N applied(ha)","Rate per hectare(kgN per ha)","Deaths","% deaths", "Cows Sold"];

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
