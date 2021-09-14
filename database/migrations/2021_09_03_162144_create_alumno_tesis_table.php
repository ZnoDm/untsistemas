<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_tesis', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alumno_codigo');
            $table->unsignedBigInteger('tesis_id');
            $table->unsignedBigInteger('docente_id');

            $table->foreign('alumno_codigo')->references('codigo')->on('alumnos')->onDelete('cascade');
            $table->foreign('tesis_id')->references('id')->on('tesis')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            
            $table->date('sustentacion')->nullable();
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
        Schema::dropIfExists('alumno_tesis');
    }
}
