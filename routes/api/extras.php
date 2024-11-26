<?php

/***** APIs sin necesidad de autorizacion *********/

/**
 * para que la tabla salga en espanol
 */
Route::get('traduccion-de-la-tabla', [
    'uses'  => 'ApiController@getTraduccionTabla',
    'as'    => 'api.getTraduccionTabla'
]);





/**
 * para APIs con necesidad de autorizacion
 */
Route::group(['middleware' => ['verifyapi']], function (){

});
