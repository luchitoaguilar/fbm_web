<?php

Route::group(['prefix' => 'tipos-de-documentos'], function (){

    /**
     * para sacar lista de tipo de documentos
     */
    Route::get('lista_tipo_documentos', [
        'uses'  => 'TipoDocumentoController@getListTipoDocumentos',
        'as'    => 'api.tipo_documento.getListTipoDocumentos'
    ]);

});
