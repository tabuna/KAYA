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


Route::screen('/projects/{project}', 'Screens\Teams\TeamsEdit','dashboard.screens.teams.edit');
Route::screen('/projects', 'Screens\Teams\TeamsList','dashboard.screens.teams.list');



Route::get('/logs/{project}','Log\LogController@index')
    ->name('dashboard.screens.logs.show');