<?php

Route::group(['prefix' => 'personas'], function (){

    /**
     * para listar las personas datatable
     */
    Route::get('listar', [
        'uses'  => 'PersonaController@getListDataTable',
        'as'    => 'api.persona.getListDataTable'
    ]);

    /**
     * para sacar los datos escenciales de la persona
     */
    Route::get('persona/{persona_id}', [
        'uses'  => 'PersonaController@getPersona',
        'as'    => 'api.persona.getPersona'
    ]);

    /**
     * para guardar una persona
     */
    Route::post('guardar-persona', [
        'uses'  => 'PersonaController@storePersona',
        'as'    => 'api.persona.storePersona'
    ]);

    /**
     * para aliminar a una persona
     */
    Route::delete('eliminar-persona/{person_id}', [
        'uses'  => 'PersonaController@deletePersona',
        'as'    => 'api.persona.deletePersona'
    ]);


    /**
     * para sacar lista de personas
     * ?buscar a las personas registradas en la base de datos
     */
    Route::get('lista-personas', [
        'uses'  => 'PersonaController@getListPersonas',
        'as'    => 'api.persona.getListPersonas'
    ]);

});
