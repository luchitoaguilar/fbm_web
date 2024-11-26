<?php

Route::group(['prefix' => 'documentos'], function () {

    /**
     * para mostrar los documentos
     */
    Route::get('listar', [
        'uses'  => 'DocumentoController@getListDocumento',
        'as'    => 'api.documento.getListDocumentos'
    ]);

    /**
     * para mostrar la bandeja de entrada
     */
    Route::get('listar-documentos-entrada', [
        'uses'  => 'DocumentoController@getListDocumentosEntrada',
        'as'    => 'api.documento.getListDocumentosEntrada'
    ]);

    /**
     * para mostrar la bandeja de salida
     */
    Route::get('listar-documentos-salida', [
        'uses'  => 'DocumentoController@getListDocumentosSalida',
        'as'    => 'api.documento.getListDocumentosSalida'
    ]);

    /**
     * para mostrar la bandeja de salida
     */
    Route::get('listar-documentos-enviados', [
        'uses'  => 'DocumentoController@getListDocumentosEnviados',
        'as'    => 'api.documento.getListDocumentosEnviados'
    ]);

    /**
     * crear documento
     */
    Route::post('crear-documento', [
        'uses'  => 'DocumentoController@createDocumento',
        'as'    => 'api.documento.createDocumento'
    ]);

    /**
     * despachar documento
     */
    Route::get('despachar-documento/{documento_id}', [
        'uses'  => 'DocumentoController@despacharDocumento',
        'as'    => 'api.documento.despacharDocumento'
    ]);

    /**
     * derivar documento
     */
    Route::post('derivar-documento', [
        'uses'  => 'DocumentoController@derivarDocumento',
        'as'    => 'api.documento.derivarDocumento'
    ]);

    /**
     * guardar
     */
    Route::post('guardar-documento', [
        'uses'  => 'DocumentoController@storeDocumento',
        'as'    => 'api.documento.storeDocumento'
    ]);


    /**
     * info
     */
    Route::get('documento/{documento_id}', [
        'uses'  => 'DocumentoController@getDocumento',
        'as'    => 'api.documento.getDocumento'
    ]);

    /**
     * documentos salida
     */
    Route::get('documento-salida/{documento_id}', [
        'uses'  => 'DocumentoController@getDocumentoSalida',
        'as'    => 'api.documento.getDocumentoSalida'
    ]);

    /**
     * editar
     */
    Route::get('editar-documento/{documento_id}', [
        'uses'  => 'DocumentoController@editDocumento',
        'as'    => 'api.documento.editDocumento'
    ]);

    /**
     * actualizar
     */
    Route::post('actualizar-documento', [
        'uses'  => 'DocumentoController@actualizar',
        'as'    => 'api.documento.actualizar'
    ]);

    /**
     * eliminar
     */
    Route::delete('eliminar-documento/{documento_id}', [
        'uses'  => 'DocumentoController@deleteDocumento',
        'as'    => 'api.Documento.deleteDocumento'
    ]);

    /**
     * para listar Documentos
     * ?usuario
     */
    Route::get('listar-documentos', [
        'uses'  => 'DocumentoController@getListDocumentos',
        'as'    => 'api.documento.getListDocumentos'
    ]);

    /**
     * para hoja de Tramite
     */
    Route::get('listar-tramites', [
        'uses'  => 'DocumentoController@getListTramite',
        'as'    => 'api.documento.getListTramite'
    ]);

    /**
     * para recuperar Origen
     */
    Route::get('origen-documento', [
        'uses'  => 'DocumentoController@getOrigen',
        'as'    => 'api.documento.getOrigen'
    ]);

    /**
     * info
     */
    Route::get('datos-despacho/{hoja_tramite}', [
        'uses'  => 'DocumentoController@getDatosDespacho',
        'as'    => 'api.documento.getDatosDespacho'
    ]);

    /**
     * terminar documento
     */
    Route::get('terminar-documento/{documento_id}', [
        'uses'  => 'DocumentoController@terminarDocumento',
        'as'    => 'api.documento.terminarDocumento'
    ]);

    /**
     * recibir documento
     */
    Route::get('recibir-documento/{documento_id}', [
        'uses'  => 'DocumentoController@recibirDocumento',
        'as'    => 'api.documento.recibirDocumento'
    ]);

    /**
     * Documentos Archivo
     */
    Route::get('documento-archivo/', [
        'uses'  => 'DocumentoController@getListDocumentosArchivo',
        'as'    => 'api.documento.getListDocumentosArchivo'
    ]);

});
