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
        Schema::connection('tenant')->create('parametros_generales', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->unsignedInteger('nombre_id')->comment('Id de la tabla principal parametros_generales');
            $table->foreign('nombre_id')->references('id')->on($mainDB.'.parametros_generales');
            $table->boolean('estado')->default(0)->comment('0:No, 1:Si');
            $table->double('valor')->nullable()->comment('Valor asignado');
            $table->unsignedInteger('dato')->nullable()->comment('Dato del select');
            $table->date('date')->comment('Campo para la guardar fechas')->nullable();
            $table->string('file')->comment('Nombre del archivo')->nullable();

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
