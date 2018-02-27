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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup', 'UsersController@create')->name('signup');


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

    //课程管理
    Route::resource("lesson","LessonController");
    Route::post("lesson/uploads","LessonController@uploadImage");

    //视频管理
    Route::resource("video","VideoController");
    Route::post("video/uploads","VideoController@uploadVideo");
    Route::post("video/merge","VideoController@videoMerge");
});



Route::group(['prefix' => 'api','namespace' => 'Api'], function () {
    //标签接口
    Route::group(['prefix' => 'tag'], function () {
        Route::get('list', 'TagController@lists');
    });

    //课程视频接口
//    Route::group(['prefix' => '/lesson'], function () {
        Route::get('/lesson/{tid}', 'LessonController@lesson')->where('tid', '[0-9]+');
        Route::get('/comLesson/{row}', 'LessonController@comLesson')->where('row', '[0-9]+');
        Route::get('/hotLesson/{row}', 'LessonController@hotLesson')->where('row', '[0-9]+');
        Route::get('/range/', 'VideoController@range');
//    });

    //课程视频接口
    Route::group(['prefix' => 'videos'], function (){
//        Route::get('/{lessonId}', 'VideoController@lists');
        Route::get('hot', 'VideoController@getHost');
        Route::get('com', 'VideoController@getCommend');
        Route::get('/{lid}', 'VideoController@getLessons')->where('lid', '[0-9]+');
    });

});