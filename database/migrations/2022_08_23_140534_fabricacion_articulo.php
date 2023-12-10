<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FabricacionArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('fabricacion_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('id de fabricación del artículo');
            $table->string('nombre',255)->nullable()->comment('Nombre tipo de fabricación del artículo');

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
        Schema::dropIfExists('fabricacion_articulo');

    }
}
