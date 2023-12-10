<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PorcentajesIva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('porcentajes_iva', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id del porcentaje de IVA');
            $table->double('porcentaje')->comment('Porcentaje de IVA para los artículos');

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
        Schema::dropIfExists('porcentajes_iva');
    }
}
