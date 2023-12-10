<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('tipo_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento del tipo de artículo');
            $table->string('nombre',255)->comment('Nombre del tipo de artículo')->nullable();

            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_articulo');
    }
}
