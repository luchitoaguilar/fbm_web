<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_dependencias', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->unique();
            $table->string('descripcion')->nullable();

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
        });

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'MINISTERIO',
            'descripcion'           => 'ES LA MÁXIMA AUTORIDAD',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'VICE MINISTERIO',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'COFADENA',
            'descripcion'           => 'ES LA MÁXIMA AUTORIDAD',
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'DIRECCION',
            'descripcion'           => 'SEGUNDO NIVEL',
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'UNIDAD',
            'descripcion'           => 'TERCER NIVEL',
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\TipoDependencia::create([
            'tipo'                  => 'JEFATURA',
            'descripcion'           => 'CUARTO NIVEL',
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_dependencias');
    }
}
