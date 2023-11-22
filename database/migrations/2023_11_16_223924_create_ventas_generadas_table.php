<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasGeneradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_generadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("cliente",100);
            $table->string("tipodoc",100);
            $table->float("subtotal",25);
            $table->float("iva",5);
            $table->float("total",5);
            $table->string("estado",50);
            $table->string("documento",500);
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
        Schema::dropIfExists('ventas_generadas');
    }
}
