<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustentoTributarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustento_tributario', function (Blueprint $table) {
            $table->increments('id')->comment('Llave primaria autoincremento');
            $table->string('codigo')->nullable()->comment('codigo del sustento');
            $table->string('nombre')->nullable()->comment('nombre del sustento');

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
        Schema::dropIfExists('sustento_tributario');
    }
}
