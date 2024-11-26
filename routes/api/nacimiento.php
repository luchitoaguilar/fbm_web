<?php

Route::group(['prefix' => 'nacimiento'], function (){

    /**
     * para sacar lista de las ciudades
     */
    Route::get('lista-nacimientos', [
        'uses'  => 'NacimientoController@getListCiudadesNacimiento',
        'as'    => 'api.nacimiento.getListCiudadesNacimiento'
    ]);


});

