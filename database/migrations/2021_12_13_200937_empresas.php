<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id')->comment('llave principal autoincremento');
            $table->unsignedInteger('tipo_negocio')->nullable()->comment('Llave foranea tabla tipos_negocios');
            $table->string('identificacion')->index()->comment('Cedula o Ruc');
            $table->string('empresa')->index()->comment('Nombre empresa');
            $table->string('razon_social')->index()->nullable(true)->comment('Razón social empresa');
            $table->unsignedInteger('representante_id')->nullable()->comment('usuario representante legal empresa');
            $table->string('ruc_contador')->nullable()->comment('ruc del contador');
            $table->string('telefono')->nullable()->comment('telefono empresa');
            $table->string('fax')->nullable()->comment('fax empresa');
            $table->string('email')->nullable()->comment('email empresa');
            $table->string('direccion')->nullable()->comment('dirección empresa');
            $table->unsignedInteger('pais_id')->default(1)->comment('llave foranea tabla paises por defecto ecuador');
            $table->unsignedInteger('provincia_id')->comment('llave foranea tabla provincias');
            $table->unsignedInteger('ciudad_id')->comment('llave foranea tabla ciudades');
            $table->string('resolucion')->nullable()->comment('Resolucion contribuyente especial');
            $table->date('fecha_vencimiento')->comment('fecha vencimiento empresa');
            $table->boolean('ambiente')->default(0)->comment('Operaciones en ambiente de 0->Pruebas, 1->Produccción');
            $table->boolean('artesano')->default(0)->comment('Artesano calificado 0->No, 1->Si');
            $table->boolean('contabilidad')->default(0)->comment('Obligado a llevar contabilidad 0->No, 1->Si');
            $table->unsignedInteger('tipo_regimen_id')->nullable()->comment('id del regimen');
            $table->boolean('reteiva')->default(0)->comment('Agente retención IVA 0->No, 1->Si');
            $table->boolean('reterenta')->default(0)->comment('Agente retención renta 0->No, 1->Si');
            $table->boolean('estado')->default(0)->comment('Estado de la empresa: 0->Inactiva; 1->Activa');
            $table->string('database')->unique()->comment('nombre de la base de datos de la empresa');
            $table->string('logo')->nullable()->comment('logo empresa');
            $table->string('firma')->nullable()->comment('firma empresa');
            $table->integer('alto_firma')->default(90)->comment('tamaño alto firma');
            $table->integer('ancho_firma')->default(128)->comment('tamaño ancho firma');
            $table->boolean('electronica')->default(0)->comment('indica si maneja facturación electrónica: 0-> No; 1->Si');
            
            $table->foreign('tipo_negocio')->references('id')->on('tipos_negocios');
            $table->foreign('representante_id')->references('id')->on('users');
            $table->foreign('ciudad_id')->references('id')->on('ciudades');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('tipo_regimen_id')->references('id')->on('tipo_regimens');
            
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('empresas');
    }
}