<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Predeterminados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('predeterminados', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();
            
            $table->increments('id')->comment('Llave primaria autoincremento');         
                        
            $table->unsignedInteger('facturas_id')->nullable()->comment('Factura local predenterminado');
            $table->foreign('facturas_id')->references('id')->on('comprobantes');
            $table->unsignedInteger('retenciones_id')->nullable()->comment('Retencion local predenterminado');
            $table->foreign('retenciones_id')->references('id')->on('comprobantes');
            $table->unsignedInteger('nota_credito_id')->nullable()->comment('Nota de crédito local predenterminado');
            $table->foreign('nota_credito_id')->references('id')->on('comprobantes');
            $table->unsignedInteger('guias_id')->nullable()->comment('Guia de remisión local predenterminado');
            $table->foreign('guias_id')->references('id')->on('comprobantes');
            $table->unsignedInteger('liq_compra_id')->nullable()->comment('Liquidacion de compra local predenterminado');
            $table->foreign('liq_compra_id')->references('id')->on('comprobantes'); 

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
        Schema::dropIfExists('predeterminados');
    }
}