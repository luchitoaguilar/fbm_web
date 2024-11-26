<?php

Route::group(['prefix' => 'prioridades'], function (){

    /**
     * para sacar lista de prioridades
     */
    Route::get('lista_prioridades', [
        'uses'  => 'PrioridadController@getListPrioridades',
        'as'    => 'api.prioridad.getListPrioridades'
    ]);

});
