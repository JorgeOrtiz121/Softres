<?php

use App\Models\Dashboard\FabricacionArticulo;
use Illuminate\Database\Seeder;

class FabricacionArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FabricacionArticulo::created(['nombre'=>'Original']);
        FabricacionArticulo::created(['nombre'=>'Genérico']);
    }
}
