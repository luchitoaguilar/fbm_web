<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->string('nombre')->nullable();
            $table->string('datos')->nullable();
            $table->double('precio')->nullable();
            $table->string('imagen_fondo')->nullable();
            $table->string('imagen_frente')->nullable();
            $table->string('enlace')->nullable();
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
        Schema::dropIfExists('banner');
    }
}
