<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rol')->unique();

            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
        });

        \App\Models\Rol::create([
            'rol'                   => 'ADMINISTRADOR',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);


        \App\Models\Rol::create([
            'rol'                   => 'OPERADOR',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1,
        ]);

        \App\Models\Rol::create([
            'rol'                   => 'USUARIO',
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
        Schema::dropIfExists('roles');
    }
}
