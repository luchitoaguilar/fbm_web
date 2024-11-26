<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZafraZafreroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zafra_zafrero', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zafra_id')->constrained('zafra')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('zafrero_id')->constrained('zafrero')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('cod_vehiculo')->constrained('vehiculo')->cascadeOnUpdate()->restrictOnDelete();
            $table->double('peso_neto',10,3);
            $table->integer('num_recibo')->default(0);
            $table->date('fecha_ingreso');

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zafra_zafrero');
    }
}
