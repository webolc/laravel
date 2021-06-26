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
Route::any('/','IndexController@index')->name('admin.index');
Route::prefix('login')->group(function () {
    Route::any('/','LoginController@index')->name('admin.login');
    Route::post('/login','LoginController@login')->name('admin.login.login');
    Route::post('/reg','LoginController@register')->name('admin.login.reg');
});
// 需要授权的接口
Route::group(['middleware' => 'auth:admin'], function () {
    Route::post('logout','LoginController@logout')->name('admin.login.logout');
    
});
