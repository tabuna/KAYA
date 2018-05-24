<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/


Route::screen('/projects', 'Screens\Teams\TeamsList','platform.screens.teams.list');
Route::screen('/project/{project}', 'Screens\Teams\TeamsEdit','platform.screens.teams.edit');


Route::get('/logs/{project}','Log\LogController@index')
    ->name('platform.screens.logs.show');

Route::post('/logs/{project}','Log\LogController@addTag')
    ->name('platform.screens.logs.addTag');

Route::delete('/logs/{project}','Log\LogController@removeTag')
    ->name('platform.screens.logs.removeTag');