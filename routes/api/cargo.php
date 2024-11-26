<?php

Route::group(['prefix' => 'cargos'], function (){

    /**
     * para listar las cargos datatable
     */
    Route::get('listar', [
        'uses'  => 'CargoController@getListDataTable',
        'as'    => 'api.cargo.getListDataTable'
    ]);

    /**
     * para sacar los datos escenciales del cargo
     */
    Route::get('cargo/{cargo_id}', [
        'uses'  => 'CargoController@getCargo',
        'as'    => 'api.cargo.getCargo'
    ]);

    /**
     * para guardar una cargo
     */
    Route::post('guardar-cargo', [
        'uses'  => 'CargoController@storeCargo',
        'as'    => 'api.cargo.storeCargo'
    ]);

    /**
     * para aliminar a una cargo
     */
    Route::delete('eliminar-cargo/{cargo_id}', [
        'uses'  => 'CargoController@deleteCargo',
        'as'    => 'api.cargo.deleteCargo'
    ]);


    /**
     * para sacar lista de cargos
     */
    Route::get('lista-cargos', [
        'uses'  => 'CargoController@getListCargos',
        'as'    => 'api.cargo.getListCargos'
    ]);

    /**
     * para sacar los datos de cargo dependiendo de la dependencia
     */
    Route::get('lista-cargo-con-dependencias/{dependencia_id}', [
        'uses'  => 'CargoController@getListCargoDependencia',
        'as'    => 'api.cargo.getListCargoDependencia'
    ]);
});
