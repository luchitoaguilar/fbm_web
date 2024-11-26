<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reportes'], function () {

    /**
     * para imprimir hoja de tramite
     */
    Route::get('imprimir-hoja-tramite/{id}', [
        'uses' => 'ReporteController@imprimirHojaTramite',
        'as' => 'api.reporte.imprimirHojaTramite'
    ]);
});
