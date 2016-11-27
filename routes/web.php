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

Route::match(['get', 'post'], '/', 'HomeController@index');
Route::post('tracker/create', 'TrackerController@create');
Route::get('track/{trackId}', 'TrackerController@index');

Route::post('action/create', 'ActionItemController@create');
Route::post('action/start/{actionItemId}', 'ActionHistoryController@start');
Route::post('action/stop/{actionItemId}', 'ActionHistoryController@stop');
Route::post('action/done', 'ActionItemController@set_done');

Route::get('auth/google', 'Auth\AuthController@redirectToProvider')->name('googleAuth');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/logout', 'Auth\AuthController@logout')->name('logout');