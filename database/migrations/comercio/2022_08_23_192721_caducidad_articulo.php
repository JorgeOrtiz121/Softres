<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CaducidadArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('caducidad_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id de caducidad');
            $table->unsignedInteger('id_articulo')->comment('llave foranea tabla articulo');
            $table->double('dias_notificacion')->comment('Días previos para notificar la caducidad del artículo')->nullable();
            $table->double('cantidad')->comment('Cantidad o existencia del artículo');
            $table->date('fecha_caducidad')->comment('Fecha de caducidad del artículo');
            $table->string('lote')->comment('Lote del artículo');

            $table->foreign('id_articulo')->references('id')->on('articulos');

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
        Schema::dropIfExists('caducidad_articulo');
    }
}
