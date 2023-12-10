<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbicacionArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('ubicacion_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id de la ubicación');
            $table->string('estante')->index()->comment('Estante en el que se encuentra el artículo')->nullable();
            $table->string('lado')->comment('Lado en el que se encuentra el artículo')->nullable();
            $table->string('fila')->comment('Fila en la que se encuentra el artículo')->nullable();
            $table->string('columna')->comment('Columna en la que se encuentra el artículo')->nullable();
            $table->string('adicional')->comment('Información adicional para la ubicación')->nullable();

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
        Schema::dropIfExists('ubicacion_articulo');
    }
}
