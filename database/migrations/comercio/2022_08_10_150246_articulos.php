<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('articulos', function (Blueprint $table) {
            // $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id del artículo');
            $table->string('codigo')->comment('Código del artículo')->unique();
            $table->string('nombre')->comment('Nombre del artículo');
            $table->string('nombre_factura')->comment('Nombre que aparece en la factura');
            $table->double('codigo_barras')->comment('Código de barras del artículo')->unique()->nullable();
            // $table->unsignedInteger('porcentaje_iva')->comment('Llave foránea de la tabla porcentaje_iva que se aplicará al artículo');
            $table->unsignedInteger('id_iva')->nullable()->comment('Llave foránea de la tabla tipo_iva');
            $table->string('grava_ice')->comment('Impuesto ICE del artículo');
            $table->double('factor_ice')->comment('Factor numérico del impuesto ICE (porcentaje o valor)')->nullable();
            $table->double('stock_actual')->comment('Stock, cantidades en existencia del artículo')->nullable();
            $table->double('stock_max')->comment('Cantidad máxima de existencias para aviso en compras del artículo')->nullable();
            $table->double('stock_min')->comment('Cantidad mínima de existencias para aviso en ventas del artículo')->nullable();
            $table->boolean('caduca')->comment('0 => NO, 1 => SI. Indica si el artículo es caducable y se le añadirá una caducidad');
            $table->boolean('venta_fracionada')->comment('Indica si el artículo se puede vender por fracciones 0 => NO, 1 => SI');
            $table->double('precio_compra_sin_iva')->comment('Precio de compra del artículo sin IVA');
            $table->double('precio_compra_con_iva')->comment('Precio de compra del artículo con IVA');
            $table->boolean('venta_restringida')->comment('Restringe la venta a los permisos de usuarios. 0 => NO, 1 => SI');
            $table->boolean('vehiculo')->comment('Indica si el artículo es un vehículo. 0 => NO, 1 => SI');
            $table->string('pais_origen')->comment('País de origen del artículo')->nullable();
            $table->string('descripcion')->comment('Descripción adicional del artículo')->nullable();
            $table->string('observaciones')->comment('Observaciones adicionales del artículo')->nullable();
            $table->unsignedInteger('id_fabricacion')->comment('Llave foránea de la tabla fabricacion_articulo')->nullable();
            $table->unsignedInteger('id_categoria')->comment('Llave foránea de la tabla categoria_articulo')->nullable();
            $table->unsignedInteger('id_tipo')->comment('Llave foránea de la tabla tipo_articulo')->nullable();
            $table->unsignedInteger('id_marca')->comment('Llave foránea de la tabla marca_articulo')->nullable();
            $table->unsignedInteger('id_presentacion')->comment('Llave foránea de la tabla presentacion_articulo')->nullable();
            $table->unsignedInteger('id_deducible_ir')->comment('Llave foránea de la tabla deducible_ir');
            $table->unsignedInteger('id_ubicacion')->comment('Llave foránea de la tabla ubicacion_articulo')->nullable();

            // $table->foreign('porcentaje_iva')->references('id')->on($mainDB.'.porcentajes_iva');
            $table->foreign('id_fabricacion')->references('id')->on($mainDB.'.fabricacion_articulo');
            $table->foreign('id_categoria')->references('id')->on('categoria_articulo');
            $table->foreign('id_tipo')->references('id')->on('tipo_articulo');
            $table->foreign('id_marca')->references('id')->on('marca_articulo');
            $table->foreign('id_presentacion')->references('id')->on('presentacion_articulo');
            $table->foreign('id_deducible_ir')->references('id')->on($mainDB.'.deducible_ir');
            $table->foreign('id_ubicacion')->references('id')->on('ubicacion_articulo');
            $table->foreign('id_iva')->references('id')->on('tipo_iva');
            
            $table->index('codigo');
            $table->index('nombre');
            $table->index('nombre_factura');
            $table->index('codigo_barras');

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
        Schema::dropIfExists('articulos');

    }
}
