<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarTablasAnteriores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_dependencias', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('dependencias', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('expedidos', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('personas', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('tipo_cargos', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign('usuario_creado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('usuario_modificado_id')->references('id')->on('usuarios')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('cargos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('tipo_cargos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('personas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('expedidos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('dependencias', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });

        Schema::table('tipo_dependencias', function (Blueprint $table) {
            $table->dropConstrainedForeignId('usuario_creado_id');
            $table->dropConstrainedForeignId('usuario_modificado_id');
        });
    }
}
