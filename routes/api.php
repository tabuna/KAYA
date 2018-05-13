<?php


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

Route::get('/logs', 'Api\LoggerController@write');

Route::get('/logs2',function (){
    \App\Log::create([
        'team_id' => 1,
        'message' => [],
        'remote_address' => 12,
    ]);
});
