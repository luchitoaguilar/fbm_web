<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedidos', function (Blueprint $table) {
            $table->id();
            $table->string('departamento')->unique();
            $table->string('expedido')->unique();

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

        });

        \App\Models\Expedido::create([
            'departamento'          => 'LA PAZ',
            'expedido'              => 'LP',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'COCHABAMBA',
            'expedido'              => 'CB',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'SANTA CRUZ',
            'expedido'              => 'SC',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'PANDO',
            'expedido'              => 'PN',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'ORURO',
            'expedido'              => 'OR',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'POTOSÍ',
            'expedido'              => 'PT',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'CHUQUISACA',
            'expedido'              => 'CH',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'TARIJA',
            'expedido'              => 'TJ',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Expedido::create([
            'departamento'          => 'BENI',
            'expedido'              => 'BN',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedidos');
    }
}
