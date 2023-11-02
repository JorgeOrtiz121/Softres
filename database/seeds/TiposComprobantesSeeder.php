<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\TiposComprobantes;

class TiposComprobantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = TiposComprobantes::create([
            'nombre' => 'Factura',
        ]);
        $data = TiposComprobantes::create([
            'nombre' => 'Nota de venta',
        ]);
        $data = TiposComprobantes::create([
            'nombre' => 'Retención',
        ]);
        $data = TiposComprobantes::create([
            'nombre' => 'Nota de crédito',
        ]);
        $data = TiposComprobantes::create([
            'nombre' => 'Guía de remisión',
        ]);
        $data = TiposComprobantes::create([
            'nombre' => 'Liquidación de compras',
        ]);
    }
}
