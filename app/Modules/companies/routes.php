<?php

/*
 * ====================================================================================================
 *  Messages Routes
 * ====================================================================================================
 */
Route::group(['prefix' => '/api/v1/companies', 'namespace' => 'App\Modules\companies\controllers'], function() {

    Route::post('/create', ['uses' => 'companiesController@_create', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::put('/update', ['uses' => 'companiesController@_update', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/show/{id}', ['uses' => 'companiesController@_show', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::delete('/delete/{id}', ['uses' => 'companiesController@_delete', 'middleware' => ['App\Http\Middleware\authToken']]);
});
