<?php

use App\Models\Dashboard\DeducibleIR;
use Illuminate\Database\Seeder;

class DeducibleIRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeducibleIR::create(['nombre'=>'No deducible']);
        DeducibleIR::create(['nombre'=>'Alimentación']);
        DeducibleIR::create(['nombre'=>'Educación']);
        DeducibleIR::create(['nombre'=>'Medicina']);
        DeducibleIR::create(['nombre'=>'Vestimenta']);
        DeducibleIR::create(['nombre'=>'Vivienda']);
    }
}
