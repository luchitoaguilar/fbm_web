<?php

Route::group(['prefix' => 'tipos-de-dependencias'], function (){

    /**
     * para sacar lista de los tipos de dependencia en al datatable
     */
    /*Route::get('lista-tipo-dependencias', [
        'uses'  => 'TipoDependenciaController@getTipoDependencia',
        'as'    => 'api.tipo_dependencia.getTipoDependencia'
    ]);*/

    /**
     * para sacar lista de los tipos de dependencia
     */
    Route::get('listar-tipo-dependencias', [
        'uses'  => 'TipoDependenciaController@getListTipoDependencia',
        'as'    => 'api.tipo_dependencia.getListTipoDependencia'
    ]);

    /**
     * para listar los tipo de dependencias datatable
     */
    Route::get('listar', [
        'uses'  => 'TipoDependenciaController@getListDataTable',
        'as'    => 'api.tipo_dependencia.getListDataTable'
    ]);

    /**
     * para sacar los datos escenciales del tipo de dependencia
     */
    Route::get('tipo-dependencia/{tipo_dependencia_id}', [
        'uses'  => 'TipoDependenciaController@getTipoDependencia',
        'as'    => 'api.tipo_dependencia.getTipoDependencia'
    ]);

    /**
     * para guardar una cargo
     */
    Route::post('guardar-tipo-dependencia', [
        'uses'  => 'TipoDependenciaController@storeTipoDependencia',
        'as'    => 'api.tipo_dependencia.storeTipoDependencia'
    ]);

    /**
     * para aliminar a una cargo
     */
    Route::delete('eliminar-tipo-dependencia/{tipo_dependencia_id}', [
        'uses'  => 'TipoDependenciaController@deleteTipoDependencia',
        'as'    => 'api.tipo_dependencia.deleteTipoDependencia'
    ]);
});
