<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            
            $table->increments('id')->comment('llave primaria autoincremento');
            $table->unsignedInteger('codigo_pais')->nullable()->index()->unique()->comment('codigo pais');
            $table->string('nombre_pais')->unique()->comment('nombre pais');
            $table->string('alfa2',2)->nullable()->default(null)->comment('codigo alfa2 ISO 3166/2');
            $table->string('alfa3',3)->nullable()->default(null)->comment('codigo alfa3 ISO 3166/2');
            $table->integer('indicativo')->length(3)->nullable()->default(null)->comment('indicativo pais');
            $table->string('idioma',2)->nullable()->default(null)->comment('Codigo de idioma DIAN ISO 639-1');
            
            // $table->primary('codigo_pais');

            $table->timestamps();
            $table->softdeletes();

            $table->engine='InnoDB';
            $table->charset='utf8';
            $table->collation='utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
}