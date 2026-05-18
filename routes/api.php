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

Route::middleware('api.key')->group(function () {
    Route::post('/fbads/orders', 'Api\FbAdsOrderController@store');
    Route::get('/order-sources', 'Api\OrderSourceController@index');
});

Route::post('/bank-transactions', 'Api\BankTransactionController@store');

Route::post('/customer-feedback', 'Api\CustomerFeedbackController@store');

Route::prefix('mobile-auth')->group(function () {
    Route::post('/login', 'Api\MobileAuthController@login');

    Route::middleware('mobile.api.auth')->group(function () {
        Route::get('/me', 'Api\MobileAuthController@me');
        Route::post('/logout', 'Api\MobileAuthController@logout');
    });
});
