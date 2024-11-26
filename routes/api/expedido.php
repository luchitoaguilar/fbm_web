<?php

Route::group(['prefix' => 'expedido'], function (){

    /**
     * para sacar lista de las ciudades
     */
    Route::get('lista-expedidos', [
        'uses'  => 'ExpedidoController@getListExpedidos',
        'as'    => 'api.expedido.getListExpedidos'
    ]);


});

