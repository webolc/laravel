<?php
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix'=>'v1','middleware'=>'throttle:30,20'],function(){
    Route::any('/','IndexController@index')->name('api.index');

    Route::prefix('login')->group(function () {
        Route::any('/','LoginController@index')->name('api.login');
        Route::post('/login','LoginController@login')->name('api.login.login');
        Route::post('/reg','LoginController@register')->name('api.login.reg');
    });
    // 需要授权的接口
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout','LoginController@logout')->name('api.login.logout');
            
    });
});

