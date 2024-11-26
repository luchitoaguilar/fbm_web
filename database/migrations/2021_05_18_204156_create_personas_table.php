<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('nombres');
            $table->unsignedBigInteger('ci');
            $table->string('complemento')->nullable();
            $table->foreignId('expedido_id')->constrained('expedidos')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('lugar_nacimiento_id')->constrained('ciudad')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('telefono')->nullable();
            $table->string('foto')->nullable();
            $table->string('firma_digital')->nullable();;
            $table->boolean('activo')->default(true);

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

            $table->unique(['ci', 'complemento', 'expedido_id']);
        });


        \App\Models\Persona::create([
            'paterno'               => 'AGUILAR',
            'materno'               => 'CABEZAS',
            'nombres'               => 'LUIS MIGUEL',
            'ci'                    => 5166170,
            'expedido_id'           => 1,
            'fecha_nacimiento'      => '11/11/1986',
            'lugar_nacimiento_id'      => 2,
            'telefono'              => 23443223,
            'foto'                  => 'assets/persona/persona_1660050486.jpg',
            'firma_digital'         => 'assets/images/personas/firmas/default_firma.png',

            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2
        ]);

        \App\Models\Persona::create([
            'paterno'               => 'COSME',
            'materno'               => 'MAMANI',
            'nombres'               => 'FULANITO',
            'ci'                    => 7654321,
            'expedido_id'           => 2,
            'fecha_nacimiento'      => '10/01/1984',
            'lugar_nacimiento_id'      => 2,
            'telefono'              => 23443223,
            'foto'                  => 'assets/images/personas/default_persona.png',
            'firma_digital'         => 'assets/images/personas/firmas/default_firma.png',

            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
