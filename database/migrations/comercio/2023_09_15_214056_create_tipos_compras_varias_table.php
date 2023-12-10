<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposComprasVariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_compras_varias', function (Blueprint $table) {
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->string('detalle')->comment('Nombre del tipo de compra');
            $table->unsignedInteger('cuenta_contable')->nullable()->index()->comment('llave foranea tabla cuentas_contables');
            $table->unsignedInteger('cuenta_contable_iva')->nullable()->index()->comment('llave foranea tabla cuentas_contables');

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
        Schema::dropIfExists('tipos_compras_varias');
    }
}
