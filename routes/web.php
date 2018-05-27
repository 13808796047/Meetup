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

Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');
    Route::get('about','IndexController@about');
    Route::get('/issues/create','IssuesController@create')->name('issues.create');
    Route::post('/isses/store','IssuesController@store')->name('issues.store');
    Route::get('/issues/{issue}','IssuesController@show')->name('issues.show');
    Route::delete('/issues/{issue}','IssuesController@destroy')->name('issues.destroy');
});
