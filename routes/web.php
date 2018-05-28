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


/**
 * 注册登录路由
 */
Auth::routes();
/**
 * 网站首页路由
 */
Route::namespace('Home')->group(function(){
    Route::get('/','IndexController@index');
    Route::get('about','IndexController@about');
    Route::resource('issues','IssuesController');
    Route::resource('comments','CommentsController',['only'=>'store']);
    Route::resource('photos','PhotosController',['only'=>'store']);
});
/**
 * qq登录路由
 */
Route::namespace('Auth')->prefix('auth/qq')->group(function(){
    Route::get('/', 'SocialitesController@qq');
    Route::get('callback', 'SocialitesController@callback');
});