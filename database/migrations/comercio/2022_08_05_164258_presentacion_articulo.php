<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PresentacionArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('presentacion_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('id de la marca del artículo');
            $table->string('nombre',255)->nullable()->comment('Nombre de la marca del artículo');
            $table->string('abreviatura',255)->nullable()->comment('Abreviatura del nombre la marca del artículo');

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
        Schema::dropIfExists('presentacion_articulo');

    }
}
