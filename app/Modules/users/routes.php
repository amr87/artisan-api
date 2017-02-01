<?php

/*
 * ====================================================================================================
 *  Users General Routes
 * ====================================================================================================
 */

Route::group(['prefix'=>'/api/v1/users','namespace' => 'App\Modules\users\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/',['uses' => 'usersController@_users','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/dataTables',['uses' => 'usersController@_dataTables','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/dataTables/trashed',['uses' => 'usersController@_TrasheddataTables','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::post('/register',['uses' => 'usersController@_register','as' => 'Register']);
    Route::post('/authenticate',['uses' => 'usersController@_authenticate','as' => 'Login']);
    Route::post('/auth-cookie',['uses' => 'usersController@_authCookie','as' => 'Cookie Login']);
    Route::post('/forget-password',['uses' => 'usersController@_forgetPassword','as' => 'Forget Password']);
    Route::get('/reset-password',['uses' => 'usersController@_resetPassword','as' => 'Reset Password']);
    Route::delete('/delete/{id}',['uses' => 'usersController@_delete','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::put('/update/{id}',['uses' => 'usersController@_update','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/profile/{id}',['uses' => 'usersController@_profile','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'View Users Profile']);
    Route::post('/facebook-connect',['uses' => 'usersController@_facebookConnect','as' => 'Connect Via Facebook']);
    Route::post('/avatar',['uses' => 'usersController@_uploadAvatar','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/search',['uses' => 'usersController@_search','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::post('/restore/{id}',['uses' => 'usersController@_restore','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::delete('/force-delete/{id}',['uses' => 'usersController@_forceDelete','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
  
});

/*
 * ====================================================================================================
 *  Roles Routes
 * ====================================================================================================
 */

Route::group(['prefix'=>'/api/v1/roles','namespace' => 'App\Modules\users\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/',['uses' => 'rolesController@_roles','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::post('/create',['uses' => 'rolesController@_create','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/show/{id}',['uses' => 'rolesController@_show','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::put('/update/{id}',['uses' => 'rolesController@_update','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::delete('/delete/{id}',['uses' => 'rolesController@_delete','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
     Route::get('/dataTables',['uses' => 'rolesController@_dataTables','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
});

/*
 * ====================================================================================================
 *  Permissions Routes
 * ====================================================================================================
 */

Route::group(['prefix'=>'/api/v1/permissions','namespace' => 'App\Modules\users\controllers','middleware' => ['throttle:60']], function() {

    Route::get('/',['uses' => 'permissionsController@_roles','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::post('/create',['uses' => 'permissionsController@_create','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/show/{id}',['uses' => 'permissionsController@_show','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::put('/update/{id}',['uses' => 'permissionsController@_update','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::delete('/delete/{id}',['uses' => 'permissionsController@_delete','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    Route::get('/dataTables',['uses' => 'permissionsController@_dataTables','middleware' => ['App\Http\Middleware\authToken','App\Http\Middleware\ACL'],'as' => 'Manage Users']);
    
});

