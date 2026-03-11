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

Route::post('/bank-transactions', function (Request $request) { 
    return response()->json([
        'message' => 'Bank transaction received successfully.',
        'data' => $request->all(),
    ], 200);
});