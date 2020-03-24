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
    Route::middleware(['auth'])->group(function () {
        Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
        //Route::get('/users', ['as' => 'users', 'uses' => 'UserController@index']);
        //Route::get('/transactions', ['as' => 'transactions', 'uses' => 'TransactionController@index']);

        Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {
            Route::middleware(['auth'])->group(function () {
                Route::get('/', ['as' => 'index', 'uses' => 'TransactionController@index']);
                Route::delete('/', ['as' => 'delete', 'uses' => 'TransactionController@delete']);
            });
        });

        Route::group(['prefix' => 'transaction_proofs', 'as' => 'transaction_proofs.'], function () {
            Route::middleware(['auth'])->group(function () {
                Route::get('/', ['as' => 'index', 'uses' => 'TransactionProofController@index']);
            });
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::middleware(['auth'])->group(function () {
                Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
                Route::delete('/', ['as' => 'delete', 'uses' => 'UserController@delete']);
            });
        });
    });

    Auth::routes();
});


Route::get('/', function () {
    return view('pages.welcome');
});
