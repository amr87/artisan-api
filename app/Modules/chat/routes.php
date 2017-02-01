<?php

/*
 * ====================================================================================================
 *  Messages Routes
 * ====================================================================================================
 */
Route::group(['prefix'=>'/api/v1/messages','namespace' => 'App\Modules\chat\controllers'], function() {

    Route::post('/create',['uses' => 'messagesController@_create','middleware' => ['App\Http\Middleware\authToken']]);
    Route::put('/seen',['uses' => 'messagesController@_seen','middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/show/{id}',['uses' => 'messagesController@_show','middleware' => ['App\Http\Middleware\authToken']]);
    Route::delete('/delete/{id}',['uses' => 'messagesController@_delete','middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/get-conversation/{from}/{to}',['uses' => 'messagesController@_getConversation','middleware' => ['App\Http\Middleware\authToken']]);
    
});


/*
 * ====================================================================================================
 *  Conversation Routes
 * ====================================================================================================
 */
Route::group(['prefix'=>'/api/v1/conversation','namespace' => 'App\Modules\chat\controllers'], function() {

    Route::post('/create',['uses' => 'conversationController@_create','middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/show/{id}',['uses' => 'conversationController@_show','middleware' => ['App\Http\Middleware\authToken']]);
    Route::delete('/delete/{id}',['uses' => 'conversationController@_delete','middleware' => ['App\Http\Middleware\authToken']]);
    Route::get('/user/{id}',['uses' => 'conversationController@_getUserConversations','middleware' => ['App\Http\Middleware\authToken']]);
    
});