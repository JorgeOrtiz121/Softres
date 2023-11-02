<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ciudades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {

            $table->increments('id')->comment('llave primaria autoincremento');
            $table->unsignedInteger('codigo_ciudad')->nullable()->index()->comment('codigo de ciudad');
            $table->string('nombre_ciudad')->comment('nombre de ciudad')->collation('utf8_spanish_ci');
            $table->unsignedInteger('provincia_id')->nullable()->comment('llave foranea tabla provincias');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->double('latitud')->nullable()->comment('Latitud georeferenciacion');
            $table->double('longitud')->nullable()->comment('Longitud Georeferenciacion');
            
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
        Schema::dropIfExists('ciudades');
    }
}
