<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->double('precio_pago_zafrero', 10, 3)->nullable();
            $table->string('gerente_cofadena')->nullable();
            $table->string('cargo_gerente_cofadena')->nullable();
            $table->string('gerente_upab')->nullable();
            $table->string('cargo_gerente_upab')->nullable();
            $table->string('jefe_prod_upab')->nullable();
            $table->string('cargo_jefe_prod_upab')->nullable();
            $table->string('aux_prod_upab')->nullable();
            $table->string('cargo_aux_prod_upab')->nullable();
            $table->integer('gestion');
            
            $table->unsignedBigInteger('usuario_creado_id');
            $table->timestamp('fecha_creado');
            $table->unsignedBigInteger('usuario_modificado_id');
            $table->timestamp('fecha_modificado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
