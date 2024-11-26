<?php

Route::group(['prefix' => 'roles'], function (){

    /**
     * para listar las roles datatable
     */
    Route::get('listar', [
        'uses'  => 'RolController@getListDataTable',
        'as'    => 'api.rol.getListDataTable'
    ]);

    /**
     * para sacar los datos escenciales de la rol
     */
    Route::get('rol/{rol_id}', [
        'uses'  => 'RolController@getRol',
        'as'    => 'api.rol.getRol'
    ]);

    /**
     * para guardar una rol
     */
    Route::post('guardar-rol', [
        'uses'  => 'RolController@storeRol',
        'as'    => 'api.rol.storeRol'
    ]);

    /**
     * para aliminar a una rol
     */
    Route::delete('eliminar-rol/{rol_id}', [
        'uses'  => 'RolController@deleteRol',
        'as'    => 'api.rol.deleteRol'
    ]);


    /**
     * para sacar lista de rols
     * ?search=as para realizar la busqueda por as
     */
    Route::get('lista-roles', [
        'uses'  => 'RolController@getListRoles',
        'as'    => 'api.rol.getListRoles'
    ]);

});
