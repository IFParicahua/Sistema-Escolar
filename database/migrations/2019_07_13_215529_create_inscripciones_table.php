<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');	
            $table->string('observacion', 40);
            $table->unsignedBigInteger('id_cursos_paralelos');	
            $table->foreign('id_cursos_paralelos')->references('id')->on('curso_paralelos');
            $table->unsignedBigInteger('id_alumno');	
            $table->foreign('id_alumno')->references('id')->on('alumnos');
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
        Schema::dropIfExists('inscripciones');
    }
}
