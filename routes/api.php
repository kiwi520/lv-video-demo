<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::group(['prefix' => 'api','namespace' => 'Api'], function () {
//    //标签接口
//    Route::group(['prefix' => 'tag'], function () {
//        Route::get('list', 'TagController@lists');
//    });
//
//    //课程视频接口
//    Route::group(['prefix' => '/lesson'], function () {
//        Route::get('/{tid}', 'LessonController@lesson')->where('tid', '[0-9]+');;
//    });
//
//    //课程视频接口
//    Route::group(['prefix' => 'videos'], function () {
//        Route::get('/{lessonId}', 'VideoController@lists');
//        Route::get('hot', 'VideoController@getHost');
//        Route::get('com', 'VideoController@getCommend');
//        Route::get('/{lid}', 'VideoController@getLessons')->where('lid', '[0-9]+');
//    });
//
//});