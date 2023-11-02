<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParametrosGenerales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros_generales', function (Blueprint $table) {
            
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->string('modulo')->nullable()->comment('Nombre del modulo');
            $table->string('nombre')->nullable()->comment('Nombre de la configuracion');
            $table->boolean('estado')->default(0)->comment('0:No, 1:Si');
            $table->double('valor')->nullable()->comment('Valor asignado');
            $table->unsignedInteger('dato')->nullable()->comment('Dato del select');
            $table->boolean('checkbox')->default(0)->comment('Indica si usa checkbox');
            $table->boolean('number')->default(0)->comment('Indica si usa number');
            $table->boolean('select')->default(0)->comment('Indica si usa select');
            $table->boolean('file')->default(0)->comment('Indica si usa archivo');
            $table->boolean('text')->default(0)->comment('Indica si usa text');
            $table->boolean('date')->default(0)->comment('Indica si usa fecha');
            $table->boolean('password')->default(0)->comment('Indica si usa clave');

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
        Schema::dropIfExists('parametros_generales');
    }
}