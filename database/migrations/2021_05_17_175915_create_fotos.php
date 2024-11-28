<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->string('detalle')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('fotos');
    }
}
