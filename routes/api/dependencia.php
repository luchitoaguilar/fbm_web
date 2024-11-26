<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dependencias'], function (){

    /**
     * para mostrar las dependencias laravel puro(problemas en hacer recursivo un balde)
     */
    Route::get('lista-dependencias', [
        'uses'  => 'DependenciaController@getDependencias',
        'as'    => 'api.dependencia.getDependencias'
    ]);

    /**
     * para mostrar las dependencias
     */
    Route::get('listar-dependencias', [
        'uses'  => 'DependenciaController@getListDependencias',
        'as'    => 'api.dependencia.getListDependencias'
    ]);

    /**
     * crear dependencia
     */
    Route::post('crear-dependencia', [
        'uses'  => 'DependenciaController@createDependencias',
        'as'    => 'api.dependencia.createDependencias'
    ]);

    /**
     * para listar ciudades
     */
    Route::get('listar-ciudades', [
        'uses'  => 'DependenciaController@getListCiudad',
        'as'    => 'api.dependencia.getListCiudad'
    ]);

 /**
     * guardar
     */
    Route::post('guardar-dependencia', [
        'uses'  => 'DependenciaController@storeDependencia',
        'as'    => 'api.dependencia.storeDependencia'
    ]);

    /**
     * recuperar los datos de la dependencia seleccionada
     */
    Route::get('dependencia/{id}', [
        'uses'  => 'DependenciaController@getDatosDependencia',
        'as'    => 'api.dependencia.getDatosDependencia'
    ]);

    /**
     * para Eliminar a una dependencia
     */
    Route::delete('eliminar-dependencia/{id}', [
        'uses'  => 'DependenciaController@deleteDependencia',
        'as'    => 'api.dependencia.deleteDependencia'
    ]);


});
