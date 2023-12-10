<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Provincias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            
            $table->increments('id')->comment('llave principal autoincremento');
            $table->unsignedInteger('codigo_provincia')->nullable()->index()->comment('codigo provincia');
            $table->string('nombre_provincia')->comment('nombre provincia');
            $table->unsignedInteger('pais_id')->nullable()->comment('llave foranea tabla paises');
            $table->foreign('pais_id')->references('id')->on('paises');
            
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('provincias');
    }
}