<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('dependencia_padre_id')->default(0);
            $table->foreignId('tipo_dependencia_id')->constrained('tipo_dependencias')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('dependencia');
            $table->string('sigla');
            $table->unsignedBigInteger('ciudad');
            $table->unsignedTinyInteger('prioridad')->default(0);
            $table->unsignedTinyInteger('nivel')->default(0);



            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

            $table->unique(['dependencia_padre_id', 'tipo_dependencia_id', 'dependencia']);
        });

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 0,
            'tipo_dependencia_id'   => 1,
            'dependencia'           => 'MINISTERIO DE DEFENSA',
            'sigla'                => 'MINDEF',
            'ciudad'                => 1,
            'prioridad'             => 0,
            'nivel'                 => 0,
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 1,
            'tipo_dependencia_id'   => 2,
            'dependencia'           => 'VICE MINISTERIO DE LUCHA CONTRA EL CONTRABANDO',
            'sigla'                => 'MINLCC',
            'ciudad'                => 1,
            'prioridad'             => 1,
            'nivel'                 => 1,
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 0,
            'tipo_dependencia_id'   => 3,
            'dependencia'           => 'COFADENA',
            'sigla'                => 'COF',
            'ciudad'                => 1,
            'prioridad'             => 0,
            'nivel'                 => 0,
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 3,
            'tipo_dependencia_id'   => 4,
            'dependencia'           => 'DIRECCION ADMINISTRATIVA FINANCIERA',
            'sigla'                => 'DAF',
            'ciudad'                => 1,
            'prioridad'             => 1,
            'nivel'                 => 1,
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 3,
            'tipo_dependencia_id'   => 4,
            'dependencia'           => 'DIRECCION DE COMERCIALIZACION',
            'sigla'                => 'DIRCOM',
            'ciudad'                => 1,
            'prioridad'             => 1,
            'nivel'                 => 1,
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 4,
            'tipo_dependencia_id'   => 5,
            'dependencia'           => 'UNIDAD DE TECNOLOGIAS DE LA INFORMACION',
            'sigla'                => 'UTIC',
            'ciudad'                => 1,
            'prioridad'             => 1,
            'nivel'                 => 1,
            'usuario_creado_id'     => 2,
            'usuario_modificado_id' => 2,
        ]);

        \App\Models\Dependencia::create([
            'dependencia_padre_id'  => 6,
            'tipo_dependencia_id'   => 6,
            'dependencia'           => 'JEFATURA DESARROLLO DE SISTEMAS',
            'sigla'                => 'UTIC-JDS',
            'ciudad'                => 1,
            'prioridad'             => 1,
            'nivel'                 => 1,
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
        Schema::dropIfExists('dependencias');
    }
}
