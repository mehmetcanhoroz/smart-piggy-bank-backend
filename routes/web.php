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

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
    Route::get('/login', function () {
        return view('pages.login');
    });
});


Route::get('/', function () {
    return view('pages.welcome');
});
