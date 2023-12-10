<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('Llave principal de la tabla');
            $table->string('user')->unique()->comment('Asignacion para el campo de idientificacion usuario');
            $table->string('name')->comment('Campo para asignar el nombre');
            $table->string('email')->nullable()->comment('Campo para asignar el correo electronico');
            $table->double('telefono')->nullable()->comment('telefono del usuario');
            $table->date('fecha_nacimiento')->nullable()->comment('fecha nacimiento del usuario');
            $table->boolean('usuario_empresa')->default(0)->nullable()->comment('Usuario de empresa 1->Si;0->No');
            $table->unsignedInteger('cargo_id')->nullable()->comment('Tipo de cargo dependientdo de los tipos de cargos del de la tabla user_cargos');
            // $table->foreign('cargo_id')->references('id')->on('users_cargos');
            $table->string('imagen')->default("user.png")->comment('Imagen de usuario');
            $table->string('password')->comment('Campo para asignar la contraseña del user');
            $table->boolean('estado')->default(false)->comment('1->Activo;0->Inactivo');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
