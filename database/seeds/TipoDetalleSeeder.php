<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\TipoDetalles;

class TipoDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = TipoDetalles::create(['nombre' => 'Tipo de documentos proveedores']); // 1
        $data = TipoDetalles::create(['nombre' => 'Tipo de categorias proveedores']); // 2
        $data = TipoDetalles::create(['nombre' => 'Tipo de proveedores']); // 3
        $data = TipoDetalles::create(['nombre' => 'Tipo de ubicaciones proveedores']); // 4
        $data = TipoDetalles::create(['nombre' => 'Tipo de retencion proveedores']); // 5

        $data = TipoDetalles::create(['nombre' => 'Tipo documentos clientes']); // 6
        $data = TipoDetalles::create(['nombre' => 'Tipo Categoria clientes']); // 7
        $data = TipoDetalles::create(['nombre' => 'Tipo de clientes']); // 8
        $data = TipoDetalles::create(['nombre' => 'Tipo estado clientes']); // 9
        $data = TipoDetalles::create(['nombre' => 'Tipo sexo clientes']); // 10
        $data = TipoDetalles::create(['nombre' => 'Tipo estado civil clientes']); // 11

    }
}
