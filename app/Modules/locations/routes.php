<?php

/*
 * ====================================================================================================
 *  Users General Routes
 * ====================================================================================================
 */

Route::group(['prefix' => '/api/v1/countries', 'namespace' => 'App\Modules\locations\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/', ['uses' => 'countriesController@_countries', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/dataTables', ['uses' => 'countriesController@_dataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/{id}/states/dataTables', ['uses' => 'countriesController@_StatesdataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::post('/create', ['uses' => 'countriesController@_create', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::delete('/delete/{id}', ['uses' => 'countriesController@_delete', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::put('/update/{id}', ['uses' => 'countriesController@_update', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/show/{id}', ['uses' => 'countriesController@_countries', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
});

/*
 * ====================================================================================================
 *  Roles Routes
 * ====================================================================================================
 */

Route::group(['prefix' => '/api/v1/states', 'namespace' => 'App\Modules\locations\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/', ['uses' => 'statesController@_states', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/{id}/districts/dataTables', ['uses' => 'statesController@_DistrictsdataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::post('/create', ['uses' => 'statesController@_create', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/show/{id}', ['uses' => 'statesController@_show', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::put('/update/{id}', ['uses' => 'statesController@_update', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::delete('/delete/{id}', ['uses' => 'statesController@_delete', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/dataTables', ['uses' => 'statesController@_dataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
});

/*
 * ====================================================================================================
 *  Permissions Routes
 * ====================================================================================================
 */

Route::group(['prefix' => '/api/v1/districts', 'namespace' => 'App\Modules\locations\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/', ['uses' => 'districtsController@_districts', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::post('/create', ['uses' => 'districtsController@_create', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/show/{id}', ['uses' => 'districtsController@_show', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::put('/update/{id}', ['uses' => 'districtsController@_update', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::delete('/delete/{id}', ['uses' => 'districtsController@_delete', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
    Route::get('/dataTables', ['uses' => 'districtsController@_dataTables', 'middleware' => ['App\Http\Middleware\authToken', 'App\Http\Middleware\ACL'], 'as' => 'Manage Locations']);
});

