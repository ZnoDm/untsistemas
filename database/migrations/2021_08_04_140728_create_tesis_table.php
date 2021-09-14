<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesis', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('file_tesis');
            $table->string('file_informe_final')->nullable();
            
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesis');
    }
}
