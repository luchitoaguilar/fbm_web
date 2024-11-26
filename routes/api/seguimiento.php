<?php

Route::group(['prefix' => 'seguimientos'], function (){

    /**
     * para mostrar los datos de seguimiento dependiendo del usuario logueado
     */
    Route::get('listar-seguimientos', [
        'uses'  => 'SeguimientoController@getListSeguimientos',
        'as'    => 'api.seguimiento.getListSeguimientos'
    ]);

    /**
     * guardar
     */
    Route::post('guardar-seguimiento', [
        'uses'  => 'SeguimientoController@storeSeguimientoUpdateDocumento',
        'as'    => 'api.seguimiento.storeSeguimientoUpdateDocumento'
    ]);

    /**
     * info
     */
    Route::get('documento/{documento_id}', [
        'uses'  => 'SeguimientoController@getSeguimiento',
        'as'    => 'api.seguimiento.getSeguimiento'
    ]);

    /**
     * recibir
     */
    Route::get('recibir-seguimiento/{seguimiento_id}', [
        'uses'  => 'SeguimientoController@recibirSeguimiento',
        'as'    => 'api.seguimiento.recibirSeguimiento'
    ]);

    /**
     * derivar
     */
    Route::get('derivar-documento/{seguimiento_id}', [
        'uses'  => 'SeguimientoController@derivarDocumento',
        'as'    => 'api.seguimiento.derivarDocumento'
    ]);

    /**
     * derivar
     */
    Route::get('datos-seguimiento/{seguimiento_id}', [
        'uses'  => 'SeguimientoController@datosSeguimiento',
        'as'    => 'api.seguimiento.datosSeguimiento'
    ]);

    /**
     * fusionar archivos
     */
    Route::post('fusionar-archivo', [
        'uses'  => 'SeguimientoController@fusionarArchivo',
        'as'    => 'api.seguimiento.fusionarArchivo'
    ]);

});
