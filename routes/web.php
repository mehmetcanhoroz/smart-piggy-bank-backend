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

        Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'TransactionController@index']);
                Route::delete('/{id}', ['as' => 'delete', 'uses' => 'TransactionController@delete'])->where(['id' => '[0-9]+']);
                Route::get('/fake', ['as' => 'fake', 'uses' => 'TransactionController@fake']);
                Route::post('/', ['as' => 'store', 'uses' => 'TransactionController@store']);
            });
        });

        Route::group(['prefix' => 'transaction_proofs', 'as' => 'transaction_proofs.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'TransactionProofController@index']);
            });
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
                Route::delete('/{id}', ['as' => 'delete', 'uses' => 'UserController@delete'])->middleware(['IsParent']);
            });
        });

        Route::group(['prefix' => 'wishlists', 'as' => 'wishlists.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'WishlistController@index']);
                Route::delete('/{id}', ['as' => 'delete', 'uses' => 'WishlistController@delete'])->middleware(['IsParent']);
            });
        });

        Route::group(['prefix' => 'statistics', 'as' => 'statistics.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'StatisticController@index']);
            });
        });

        Route::group(['prefix' => 'leaderboard', 'as' => 'leaderboard.'], function () {
            Route::group([], function () {
                Route::get('/', ['as' => 'index', 'uses' => 'LeaderBoardController@index']);
            });
        });
    });

    Auth::routes();
    Route::get('/test', ['as' => 'test', 'uses' => 'UserController@test']);
});


Route::get('/', function () {
    return view('pages.welcome');
});
