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


Route::screen('/teams2', 'Screens\Teams\TeamsList','dashboard.screens.teams.list');

Route::get('/{project}/logs','Log\LogController@index');