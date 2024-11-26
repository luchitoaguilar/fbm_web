<?php

Route::group(['prefix' => 'prioridades'], function (){

    /**
     * para sacar lista de tramites
     */
    Route::get('lista_tipo_tramites', [
        'uses'  => 'TipoTramiteController@getListTramites',
        'as'    => 'api.tipo_tramite.getListTramites'
    ]);

});
