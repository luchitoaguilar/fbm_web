<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cargos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_cargo')->unique();

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
        });

        \App\Models\TipoCargo::create([
            'tipo_cargo'            => 'ADMINISTRADOR DEL SISTEMA',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_cargos');
    }
}
