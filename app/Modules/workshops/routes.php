<?php

/*
 * ====================================================================================================
 *  Messages Routes
 * ====================================================================================================
 */
Route::group(['prefix' => '/api/v1/workshops', 'namespace' => 'App\Modules\workshops\controllers'], function() {

    Route::post('/create', ['uses' => 'workshopsController@_create', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::put('/update', ['uses' => 'workshopsController@_update', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/show/{id}', ['uses' => 'workshopsController@_show', 'middleware' => ['App\Http\Middleware\authToken']]);
    Route::delete('/delete/{id}', ['uses' => 'workshopsController@_delete', 'middleware' => ['App\Http\Middleware\authToken']]);
});


/*
 * ====================================================================================================
 *  Conversation Routes
 * ====================================================================================================
 */
Route::group(['prefix' => '/api/v1/categories', 'namespace' => 'App\Modules\workshops\controllers'], function() {

    Route::get('/dataTables', ['uses' => 'categoriesController@_dataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::get('/', ['uses' => 'categoriesController@_all', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::post('/create', ['uses' => 'categoriesController@_create', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::get('/show/{id}', ['uses' => 'categoriesController@_show', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::put('/update/{id}', ['uses' => 'categoriesController@_update', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::delete('/delete/{id}', ['uses' => 'categoriesController@_delete', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
    Route::get('/workshops/{id}', ['uses' => 'categoriesController@_getWorkshops', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Categories']);
});
