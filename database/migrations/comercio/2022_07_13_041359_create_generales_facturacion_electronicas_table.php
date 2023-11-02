<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralesFacturacionElectronicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //:connection('tenant')->
        Schema::create('parametros_fe_comprobante_correo', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();
            
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->boolean('facturas_cbte_venta')->default(0)->comment('0:No, 1:Si');
            $table->boolean('retencion_compras')->default(0)->comment('0:No, 1:Si');
            $table->boolean('guias_remision')->default(0)->comment('0:No, 1:Si');
            $table->boolean('notas_credito')->default(0)->comment('0:No, 1:Si');
            $table->double('decimales_factura')->nullable()->comment('No. decimales factura');
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
        Schema::dropIfExists('generales_facturacion_electronicas');
    }
}
