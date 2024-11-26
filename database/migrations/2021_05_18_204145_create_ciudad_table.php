<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudad', function (Blueprint $table) {
            $table->id();
            $table->string('departamento')->unique();
            $table->unsignedBigInteger('estado')->default(1);

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

        });

        \App\Models\Ciudad::create([
            'departamento'          => 'LA PAZ',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'COCHABAMBA',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'SANTA CRUZ',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'PANDO',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'ORURO',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'POTOSÍ',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'CHUQUISACA',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'TARIJA',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Ciudad::create([
            'departamento'          => 'BENI',
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
        Schema::dropIfExists('ciudad');
    }
}
