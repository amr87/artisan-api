<?php

/*
 * ====================================================================================================
 *  Messages Routes
 * ====================================================================================================
 */
Route::group(['prefix' => '/api/v1/companies', 'namespace' => 'App\Modules\companies\controllers'], function() {

    Route::get('/dataTables', ['uses' => 'companiesController@_dataTables', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
    Route::post('/create', ['uses' => 'companiesController@_create', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
    Route::post('/restore', ['uses' => 'companiesController@_restore', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
    Route::put('/update/{id}', ['uses' => 'companiesController@_update', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
    Route::get('/profile/{id}', ['uses' => 'companiesController@_show', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
    Route::delete('/delete/{id}', ['uses' => 'companiesController@_delete', 'middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Companies']);
});
