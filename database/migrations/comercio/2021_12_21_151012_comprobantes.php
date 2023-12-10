<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comprobantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('comprobantes', function (Blueprint $table) {
            $tenantDB = DB::connection('tenant')->getDatabaseName();
            $mainDB = DB::connection('mysql')->getDatabaseName();
            
            $table->increments('id')->comment('Llave primaria autoincremento');         
                        
            $table->unsignedInteger('comprobante_id')->comment('id de la tabla tipos_comprobantes');
            $table->foreign('comprobante_id')->references('id')->on($mainDB.'.tipos_comprobantes');
            $table->string('num_serie1')->nullable()->comment('numero de serie');
            $table->string('num_serie2')->nullable()->comment('Punto emicion');
            $table->boolean('tipo_comprobante')->default(0)->comment('0->Fisico; 1->Electronico');
            $table->string('autorizacion_sri')->nullable()->comment('autorizacion sri');
            $table->string('ultimo_num')->nullable()->comment('ultimo numero');
            $table->date('fecha_caducidad')->nullable()->comment('fecha de caducidad');

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
        Schema::dropIfExists('comprobantes');
    }
}