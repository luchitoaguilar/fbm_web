<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dependencia_id')->constrained('dependencias')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('cargo');

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

            $table->unique(['dependencia_id', 'cargo']);
        });

        \App\Models\Cargo::create([
            'dependencia_id'        => 1,
            'cargo'                 => 'AUXILIAR DE PRODUCCION',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\Cargo::create([
            'dependencia_id'        => 6,
            'cargo'                 => 'JEFE UTIC',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\Cargo::create([
            'dependencia_id'        => 6,
            'cargo'                 => 'ENCARGADO DE DESARROLLO DE SISTEMAS',
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
        Schema::dropIfExists('cargos');
    }
}
