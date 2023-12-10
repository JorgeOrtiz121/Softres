<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_proveedor', function (Blueprint $table) {
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->string('nombre')->nullable()->comment('nombre del tipo de proveedor');

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
        Schema::dropIfExists('tipo_proveedor');
    }
}
 