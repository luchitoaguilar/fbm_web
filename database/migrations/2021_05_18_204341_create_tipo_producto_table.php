<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_producto', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_producto')->unique();
            $table->string('descripcion')->nullable();

            $table->foreignId('usuario_creado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_creado');
            $table->foreignId('usuario_modificado_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_modificado');
        });

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'MUNICION CAL. 9X19mm',
            'descripcion'           => 'MUNICION CAL. 9X19mm',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'MUNICION CAL. 7,62X51mm',
            'descripcion'           => 'MUNICION CAL. 7,62X51mm',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'ARMAMENTO',
            'descripcion'           => 'ARMAMENTO',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'PUNTAS DE PLOMO',
            'descripcion'           => 'PUNTAS DE PLOMO',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'PRIMERS',
            'descripcion'           => 'PRIMERS',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'EQUIPO MILITAR',
            'descripcion'           => 'EQUIPO MILITAR',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'REPLICAS',
            'descripcion'           => 'REPLICAS',
            'usuario_creado_id'     => 1,
            'usuario_modificado_id' => 1
        ]);

        \App\Models\TipoProducto::create([
            'tipo_producto'        => 'OTROS',
            'descripcion'           => 'OTROS',
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
        Schema::dropIfExists('tipo_producto');
    }
}
