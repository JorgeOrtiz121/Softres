<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoAutorizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_autorizado', function (Blueprint $table) {
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->string('codigo')->nullable()->comment('codigo del sustento');
            $table->string('nombre')->nullable()->comment('nombre del sustento');
            $table->unsignedInteger('id_sustento_tributario')->nullable()->comment('llave foranea tabla sustento_tributario');

            $table->foreign('id_sustento_tributario')->references('id')->on('sustento_tributario');
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
        Schema::dropIfExists('documento_autorizado');
    }
}
