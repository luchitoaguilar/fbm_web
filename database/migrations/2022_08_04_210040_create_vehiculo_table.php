<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo');
            $table->integer('cod_vehiculo');
            $table->string('placa');
            $table->integer('gestion');
            $table->double('tara',10,3);
            $table->integer('estado')->default(1);
            $table->string('observaciones')->nullable();
            $table->string('archivo')->nullable();

            $table->foreignId('usuario_creado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_creado');
            $table->foreignId('usuario_modificado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_modificado');
        });

        \App\Models\Vehiculo::create([
            'vehiculo'        => 'Camion',
            'cod_vehiculo'           => '14',
            'placa'         => 'MD-101',
            'gestion'     => 2022,
            'tara'          => 8050.00,
            'observaciones' => '',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Vehiculo::create([
            'vehiculo'        => 'Camion',
            'cod_vehiculo'           => '7012',
            'placa'         => '02-C',
            'gestion'     => 2022,
            'tara'          => 3180.00,
            'observaciones' => '',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);
        \App\Models\Usuario::create([
            'persona_id'            => 2,
            'rol_id'                => 2,
            'cargo_id'              => 1,
            'email'               => 'aux_prod_upab@cofadena.gob.bo',
            'password'              => bcrypt('5942000'),
            'api_token'             => \Illuminate\Support\Str::random('100'),
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
        Schema::dropIfExists('vehiculo');
    }
}
