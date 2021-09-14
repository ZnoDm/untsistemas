<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoPracticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_practica', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alumno_codigo');
            $table->unsignedBigInteger('practica_id');
            $table->unsignedBigInteger('docente_id');
            
            $table->foreign('alumno_codigo')->references('codigo')->on('alumnos')->onDelete('cascade');
            $table->foreign('practica_id')->references('id')->on('practicas')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            

            $table->integer('status');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_practica');
    }
}
