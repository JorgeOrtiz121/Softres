<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\TipoRegimen;

class TipoRegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dato = TipoRegimen::create(['nombre' => 'Contribuyente régimen microempresa',]);
        $dato = TipoRegimen::create(['nombre' => 'RIMPE Negocios Populares',]);
        $dato = TipoRegimen::create(['nombre' => 'RIMPE Emprendedores',]);
        $dato = TipoRegimen::create(['nombre' => 'Régimen General',]);
    }
}
