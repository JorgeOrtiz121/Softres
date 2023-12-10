<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'user' => 'superAdmin',
            'name' => 'superAdmin',
            'email' => 'prueba@prueba.com',
            'usuario_empresa' => 0,
            'cargo_id'=>1,
            'password' => bcrypt('1111'),
            'estado' => 1,            
        ]);
    }
}
