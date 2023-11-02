<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreciosVentaArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('precios_venta_articulo', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            // $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id del precio de venta del artículo');
            $table->unsignedInteger('id_articulo')->comment('llave foranea tabla articulo');
            $table->double('precio_con_iva')->comment('Precio de venta del artículo incluido IVA');
            $table->double('utilidad')->comment('Utilidad de la venta del artículo');
            $table->double('ganancia')->comment('Ganancia de la venta del artículo');

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
        Schema::dropIfExists('precios_venta_articulo');

    }
}
