<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/comments'], function(){
    Route::post('/{target_table}/{target_id}',[
        'as' => 'commentsStore',
        'uses' => 'CommentsController@store'
    ]);

    Route::post('/{comments_id}', [
        'as' => 'recommentsStore',
        'uses' => 'CommentsController@recommentsStore'
    ]);

    Route::get('/{target_table}/{target_id}', [
        'as' => 'commentsShow',
        'uses' => 'CommentsController@index'
    ]);
});
