<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZafraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zafra', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso');
            $table->string('tipo_cosecha');
            $table->foreignId('cod_vehiculo')->constrained('vehiculo')->cascadeOnUpdate()->restrictOnDelete();
            $table->double('peso_neto',10,3);
            $table->string('observaciones')->nullable();
            $table->string('archivo')->nullable();
            $table->integer('gestion');
            $table->json('personal_zafra');
            $table->json('personal_zafra_id');
            $table->integer('estado')->default(1);
            $table->integer('num_recibo')->default(0);

            $table->foreignId('usuario_creado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_creado');
            $table->foreignId('usuario_modificado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('zafra');
    }
}
