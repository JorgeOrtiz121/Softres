<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosSeeder::class);
        $this->call(PaisesSeeder::class);
        $this->call(ProvinciasSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(TiposNegociosSeeder::class);
        $this->call(TiposComprobantesSeeder::class);
        $this->call(ParametrosGeneralesAdminSeeder::class);
        $this->call(TipoRegimenSeeder::class);
        $this->call(DeducibleIRSeeder::class);
        $this->call(TipoDetalleSeeder::class);
        $this->call(TiposGenericoSeeder::class);
    }
}
