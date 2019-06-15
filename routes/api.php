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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// 第三方登录
Route::group(['namespace' => 'Api'], function () {
// 登录
    Route::post('authorizations', 'AuthorizationsController@store')
        ->name('api.authorizations.store');
    // 刷新token
    Route::post('authorizations/update', 'AuthorizationsController@update')
        ->name('api.authorizations.update');
    // 删除token
    Route::delete('authorizations', 'AuthorizationsController@destroy')
        ->name('api.authorizations.destroy');
    //插件验证后操作
    Route::group(['middleware' => 'jwt'], function () {
        Route::post('/ceshi', function () {
            return '验证通过';
        });
    });
});
