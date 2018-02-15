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
Route::group(['prefix' => 'admin/entry','namespace' => 'Admin'], function () {
    Route::get('login', 'EntryController@loginFrom');

    Route::post('loginFrom', 'EntryController@login');
});

Route::group(['middleware' => 'admin.auth','prefix' => 'admin','namespace' => 'Admin'], function () {
     Route::get('logout', 'BaseController@logout');
    Route::group(['prefix' => 'index'], function () {
        Route::get('index', 'IndexController@index');
    });
    Route::group(['prefix' => 'member'], function () {
        Route::get('passwordFrom', 'MemberController@passwordFrom');
        Route::post('changePassword', 'MemberController@changePassword');
    });

     //标签管理
    Route::resource("tag","TagController");
});