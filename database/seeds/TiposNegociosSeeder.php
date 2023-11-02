<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\TiposNegocios;

class TiposNegociosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = TiposNegocios::create([
            'nombre' => 'Comercio general',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Farmacia',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Gasolineria',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Hotel',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Cartering',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Venta con tickets',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Servicios profecionales',
        ]);
        $data = TiposNegocios::create([
            'nombre' => 'Talleres y reparaciones',
        ]);
    }
}