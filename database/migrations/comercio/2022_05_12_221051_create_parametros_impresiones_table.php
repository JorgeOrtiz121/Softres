<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosImpresionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('parametros_impresiones', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();

            $table->increments('id');
            $table->unsignedInteger('comprobante_id')->comment('id de la tabla comprobantes');
            $table->foreign('comprobante_id')->references('id')->on($tenantDB.'.comprobantes');
            $table->unsignedInteger('diseño')->nullable()->comment('Dato del select');
            $table->unsignedInteger('impresora')->nullable()->comment('Dato del select');
            $table->double('margen_sup')->default(0)->comment('Margen superior');
            $table->double('margen_izq')->default(0)->comment('Margen Izquierdo');
            $table->double('n_copias')->default(0)->comment('Numero de copias');
            $table->boolean('copias_hoja')->default(false)->nullable()->comment('Imprimir las copias en 1 sola hoja 1->SI;0->NO');
            $table->boolean('fe_ride')->default(false)->nullable()->comment('Imprimir las facturas electronicas usando el RIDE 1->SI;0->NO');
            $table->boolean('nombre_completo')->default(false)->nullable()->comment('Imprimir RIDE usando nombre completo del producto 1->SI;0->NO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametros_impresiones');
    }
}
