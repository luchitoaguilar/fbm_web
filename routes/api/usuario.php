<?php

// para los super administradores

Route::group(['prefix' => 'usuarios'], function (){

    /**
     * para resetear el password
     */
    Route::get('resetear-password-usuario/{user_id}', [
        'uses'  => 'UsuarioController@resetPassUsuario',
        'as'    => 'api.usuario.resetPassUsuario'
    ]);

    /**
     * para el datatable
     * ?tipo=admin
     * ?sistema=chaski
     */
    Route::get('listar', [
        'uses'  => 'UsuarioController@getListDataTable',
        'as'    => 'api.usuario.getListDataTable'
    ]);

    /**
     * info
     */
    Route::get('usuario/{user_id}', [
        'uses'  => 'UsuarioController@getUsuario',
        'as'    => 'api.usuario.getUsuario'
    ]);

    /**
     * guardar
     */
    Route::post('guardar-usuario', [
        'uses'  => 'UsuarioController@storeUsuario',
        'as'    => 'api.usuario.storeUsuario'
    ]);

    /**
     * eliminar
     */
    Route::delete('eliminar-usuario/{user_id}', [
        'uses'  => 'UsuarioController@deleteUsuario',
        'as'    => 'api.usuario.deleteUsuario'
    ]);

    /**
     * para listar usuarios
     */
    Route::get('listar-usuarios', [
        'uses'  => 'UsuarioController@getListUsuarios',
        'as'    => 'api.usuario.getListUsuarios'
    ]);

    /**
     * usuario logueado
     */
    Route::get('datos-usuario-logueado', [
        'uses'  => 'UsuarioController@getDatosUsuario',
        'as'    => 'api.usuario.getDatosUsuario'
    ]);

});
