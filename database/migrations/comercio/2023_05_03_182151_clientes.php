<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('clientes', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->unsignedInteger('tipo_documento')->comment('llave foranea tabla tipos');
            $table->boolean('parte_relacionada')->default(false)->nullable()->comment('Parte relacionada 1->SI;0->NO');
            $table->string('documento')->index()->comment('documento del cliente');
            $table->string('cod_auxiliar')->index()->comment('codigo auxiliar del cliente');
            $table->string('nombre')->nullable()->comment('nombre del cliente');
            $table->string('razon_social')->nullable()->comment('razon social del cliente');
            $table->string('telefono1')->nullable()->comment('telefono principal del cliente');
            $table->string('telefono2')->nullable()->comment('telefono auxiliar del cliente');
            $table->unsignedInteger('id_categoria')->nullable()->comment('llave foranea tabla tipos');
            $table->unsignedInteger('id_tipos')->nullable()->comment('llave foranea tabla tipos');
            $table->string('direccion')->nullable()->comment('direccion del cliente');
            $table->unsignedInteger('id_ubicacion')->comment('llave foranea tabla tipos');
            $table->unsignedInteger('id_zona')->nullable()->comment('llave foranea tabla zonas');
            $table->unsignedInteger('id_lugar')->nullable()->comment('llave foranea tabla lugares');
            $table->unsignedInteger('id_pais')->comment('llave foranea tabla paises');
            $table->unsignedInteger('id_provincia')->comment('llave foranea tabla provincias');
            $table->unsignedInteger('id_ciudad')->comment('llave foranea tabla ciudades');
            $table->string('representante')->nullable()->comment('representante del cliente');
            $table->unsignedInteger('id_cuenta')->nullable()->comment('llave foranea tabla tipos');
            $table->double('puntos')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('deuda')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('afavor')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->string('email1')->nullable()->index()->comment('email1 del cliente');
            $table->string('email2')->nullable()->comment('email2 del cliente');
            $table->double('credito_max')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('max_plazo')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('descuento')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->double('intereses_mora')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->unsignedInteger('id_estado')->nullable()->comment('llave foranea tabla tipos');
            $table->unsignedInteger('id_pvp')->nullable()->comment('llave foranea tabla tipos');
            $table->string('observaciones')->nullable()->comment('observaciones generales');
            $table->string('ref_vivienda')->nullable()->comment('observaciones generales');
            $table->unsignedInteger('id_sexo')->nullable()->comment('llave foranea tabla tipos');
            $table->date('fecha_nacimiento')->nullable()->comment('fecha nacimiento cliente');
            $table->unsignedInteger('id_estado_civil')->nullable()->comment('llave foranea tabla tipos');
            $table->double('num_hijos')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->string('profesion')->nullable()->comment('observaciones generales');
            $table->double('ingreso_mensual')->default(0)->nullable()->comment('valor de cupo_credito');
            $table->string('empresa_lab')->nullable()->comment('observaciones generales');
            $table->string('referido_por')->nullable()->comment('observaciones generales');
            $table->unsignedInteger('id_vendedor')->nullable()->comment('llave foranea tabla tipos');

            $table->foreign('id_categoria')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_tipos')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('tipo_documento')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_ubicacion')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_zona')->references('id')->on($tenantDB.'.zonas');
            $table->foreign('id_lugar')->references('id')->on($tenantDB.'.lugares');
            $table->foreign('id_pais')->references('id')->on($mainDB.'.paises');
            $table->foreign('id_provincia')->references('id')->on($mainDB.'.provincias');
            $table->foreign('id_ciudad')->references('id')->on($mainDB.'.ciudades');
            // $table->foreign('id_cuenta')->references('id')->on('cuentas_bancarias');
            $table->foreign('id_estado')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_pvp')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_sexo')->references('id')->on($mainDB.'.tipos_genericos');
            $table->foreign('id_estado_civil')->references('id')->on($mainDB.'.tipos_genericos');
            // $table->foreign('id_vendedor')->references('id')->on('vendedores');

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
        Schema::dropIfExists('clientes');
    }
}