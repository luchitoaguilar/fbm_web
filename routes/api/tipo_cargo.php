<?php

Route::group(['prefix' => 'tipos-de-cargos'], function (){

    /**
     * para sacar lista de las ciudades
     */
    Route::get('lista-tipo-cargo', [
        'uses'  => 'TipoCargoController@getTipoCargo',
        'as'    => 'api.tipo_cargo.getTipoCargo'
    ]);

});
