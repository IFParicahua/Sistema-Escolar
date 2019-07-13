<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_mes');
            $table->decimal('monto', 10, 2);
            $table->char('estado', 1);
            $table->dateTime('fecha_pago');
            $table->string('descripcion_cuo', 20);
            $table->unsignedBigInteger('id_inscripcion');	
            $table->foreign('id_inscripcion')->references('id')->on('inscripciones');
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
        Schema::dropIfExists('cuotas');
    }
}
