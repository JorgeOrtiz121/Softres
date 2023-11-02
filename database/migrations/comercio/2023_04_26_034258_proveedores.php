<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('proveedores', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento. Id de caducidad');
            $table->unsignedInteger('tipo_documento')->comment('llave foranea tabla tipos');
            $table->string('documento')->index()->comment('documento del proveedor');
            $table->string('nombre')->nullable()->comment('nombre del proveedor');
            $table->string('razon_social')->nullable()->comment('razon social del proveedor');
            $table->string('representante')->nullable()->comment('representante del proveedor');
            $table->unsignedInteger('id_categoria')->nullable()->comment('llave foranea tabla tipos');
            $table->unsignedInteger('id_tipos')->nullable()->comment('llave foranea tabla tipos');
            $table->boolean('artesano')->default(false)->nullable()->comment('Artesano 1->SI;0->NO');
            $table->unsignedInteger('id_ubicacion')->comment('llave foranea tabla tipos');
            $table->string('direccion')->nullable()->comment('direccion del proveedor');
            $table->string('telefono')->nullable()->comment('telefono del proveedor');
            $table->string('web')->nullable()->comment('pagina web del proveedor');
            $table->string('email1')->nullable()->index()->comment('email1 del proveedor');
            $table->string('email2')->nullable()->comment('email2 del proveedor');
            $table->unsignedInteger('id_pais')->comment('llave foranea tabla paises');
            $table->unsignedInteger('id_provincia')->comment('llave foranea tabla provincias');
            $table->unsignedInteger('id_ciudad')->comment('llave foranea tabla ciudades');
            $table->double('cupo_credito')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('cxp')->default(0)->nullable()->comment('valor de cxp');
            $table->double('notas')->default(0)->nullable()->comment('valor de notas');
            $table->string('observaciones')->nullable()->comment('observaciones generales');
            $table->unsignedInteger('id_subproveedor')->nullable()->comment('llave foranea tabla tipos');
            $table->unsignedInteger('id_retencion')->nullable()->comment('llave foranea tabla tipos');
            $table->double('retencion_iva_bienes')->nullable()->comment('cantidad de retencion_iva_bienes');
            $table->double('retencion_iva_servicios')->nullable()->comment('cantidad de retencion_iva_servicios');

            $table->foreign('tipo_documento')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_categoria')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_tipos')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_ubicacion')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_pais')->references('id')->on($mainDB.'.paises');
            $table->foreign('id_provincia')->references('id')->on($mainDB.'.provincias');
            $table->foreign('id_ciudad')->references('id')->on($mainDB.'.ciudades');
            // $table->foreign('id_subproveedor')->references('id')->on($mainDB.'.proveedores');
            $table->foreign('id_retencion')->references('id')->on($mainDB.'.tipos_genericos');

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
        Schema::dropIfExists('proveedores');
    }
}

