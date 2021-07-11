<?php

use Illuminate\Support\Facades\Route;

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
Route::any('/','IndexController@index');
Route::prefix('login')->group(function () {
    Route::get('/','LoginController@index')->name('login.index');
    Route::any('/login','LoginController@login')->name('login.login');
    Route::any('/reg','LoginController@register')->name('login.reg');
});
// 需要授权的接口
Route::group(['middleware' => 'auth'], function () {
    Route::any('logout','LoginController@logout')->name('login.logout');
    
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
