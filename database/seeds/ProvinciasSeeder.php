<?php

use Illuminate\Database\Seeder;
use App\Models\Dashboard\Provincias;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Provincias::create([
            'nombre_provincia' => 'Azuay',
        ]);

        $data = Provincias::create([
            'nombre_provincia' => 'Bolívar',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Cañar',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Carchi',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Chimborazo',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Cotopaxi',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'El Oro',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Esmeraldas',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Galápagos',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Guayas',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Imbabura',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Loja',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Los Ríos',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Manabí',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Morona-Santiago',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Napo',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Orellana',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Pastaza',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Pichincha',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Santa Elena',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Santo Domingo de los Tsáchilas',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Sucumbíos',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Tungurahua',
        ]);
        $data = Provincias::create([
            'nombre_provincia' => 'Zamora-Chinchipe',
        ]);
       
    }
}
