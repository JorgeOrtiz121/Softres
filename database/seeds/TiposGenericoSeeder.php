<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\TiposGenerico;

class TiposGenericoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = TiposGenerico::create(['nombre' => 'CED', 'id_tipo' => 1]);
        $data = TiposGenerico::create(['nombre' => 'RUC', 'id_tipo' => 1]);
        $data = TiposGenerico::create(['nombre' => 'PAS', 'id_tipo' => 1]);
        $data = TiposGenerico::create(['nombre' => 'Categoria 1', 'id_tipo' => 2]);
        $data = TiposGenerico::create(['nombre' => 'Tipo 1', 'id_tipo' => 3]);
        $data = TiposGenerico::create(['nombre' => 'Local', 'id_tipo' => 4]);
        $data = TiposGenerico::create(['nombre' => 'Regional', 'id_tipo' => 4]);
        $data = TiposGenerico::create(['nombre' => 'Nacional', 'id_tipo' => 4]);
        $data = TiposGenerico::create(['nombre' => 'Extranjero', 'id_tipo' => 4]);
        $data = TiposGenerico::create(['nombre' => '312: Transferencia de bienes de naturaleza corporal', 'id_tipo' => 5]);
        $data = TiposGenerico::create(['nombre' => '343: Otras retenciones aplicables al 1%', 'id_tipo' => 5]);

        $data = TiposGenerico::create(['nombre' => 'Consumidor final','id_tipo' => 6]);
        $data = TiposGenerico::create(['nombre' => 'Cédula','id_tipo' => 6]);
        $data = TiposGenerico::create(['nombre' => 'RUC','id_tipo' => 6]);
        $data = TiposGenerico::create(['nombre' => 'Pasaporte','id_tipo' => 6]);
        $data = TiposGenerico::create(['nombre' => 'Empresa','id_tipo' => 7]);
        $data = TiposGenerico::create(['nombre' => 'Institución','id_tipo' => 7]);
        $data = TiposGenerico::create(['nombre' => 'Persona','id_tipo' => 7]);
        $data = TiposGenerico::create(['nombre' => 'Mayorista','id_tipo' => 8]);
        $data = TiposGenerico::create(['nombre' => 'Minorista','id_tipo' => 8]);
        $data = TiposGenerico::create(['nombre' => 'Con acceso','id_tipo' => 9]);
        $data = TiposGenerico::create(['nombre' => 'Sin acceso a crédito','id_tipo' => 9]);
        $data = TiposGenerico::create(['nombre' => 'Bloqueo total','id_tipo' => 9]);
        $data = TiposGenerico::create(['nombre' => 'Masculino','id_tipo' => 10]);
        $data = TiposGenerico::create(['nombre' => 'Femenino','id_tipo' => 10]);
        $data = TiposGenerico::create(['nombre' => 'Soltero','id_tipo' => 11]);
        $data = TiposGenerico::create(['nombre' => 'Casado','id_tipo' => 11]);
        $data = TiposGenerico::create(['nombre' => 'Divorciado','id_tipo' => 11]);
        $data = TiposGenerico::create(['nombre' => 'Viudo','id_tipo' => 11]);
        $data = TiposGenerico::create(['nombre' => 'Unión de hecho','id_tipo' => 11]);

    }
}
