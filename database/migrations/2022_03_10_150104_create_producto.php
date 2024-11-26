<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->foreignId('id_ciudad')->constrained('ciudad')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('tipo_producto')->constrained('tipo_producto')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nombre')->nullable();
            $table->double('precio')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('enlace')->nullable();
            $table->string('presentacion')->nullable();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('estado')->default(1);


            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
            $table->unsignedBigInteger('usuario_borrado_id')->nullable();
            $table->timestamp('fecha_borrado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
