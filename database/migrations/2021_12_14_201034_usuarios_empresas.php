<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_empresas', function (Blueprint $table) {
            
            $table->increments('id')->comment('Llave primaria autoincremento');         
                        
            $table->unsignedInteger('usuario_id')->comment('id del usuario');
            $table->foreign('usuario_id')->references('id')->on('users');
            
            $table->unsignedInteger('empresa_id')->comment('id de la empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas'); 

            $table->unsignedInteger('cargo_usuario_id')->nullable()->comment('Cargo del usuario');
            // $table->foreign('cargo_usuario_id')->references('id')->on('cargos_usuarios_comercial'); 
            
            $table->boolean('estado')->default(1)->comment('1->Activo;0->Inactivo');

            $table->unsignedInteger('user_id')->nullable()->comment('id del usuario que realiza la acción');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_empresas');
    }
}