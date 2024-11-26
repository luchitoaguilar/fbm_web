<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('rol_id')->constrained('roles')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('cargo_id')->constrained('cargos')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('activo')->default(true);
            $table->string('api_token')->nullable();

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');

            $table->unique(['persona_id', 'rol_id', 'cargo_id']);
        });

        \App\Models\Usuario::create([
            'persona_id'            => 1,
            'rol_id'                => 2,
            'cargo_id'              => 1,
            'email'               => 'jefe_com_fbm@cofadena.gob.bo',
            'password'              => bcrypt('5166170'),
            'api_token'             => \Illuminate\Support\Str::random('100'),
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);
        \App\Models\Usuario::create([
            'persona_id'            => 2,
            'rol_id'                => 1,
            'cargo_id'              => 1,
            'email'               => 'fbm@cofadena.gob.bo',
            'password'              => bcrypt('C0f4d3n4_'),
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
        Schema::dropIfExists('usuarios');
    }
}
