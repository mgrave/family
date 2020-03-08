<?php

use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:airlock')->prefix('admin')->group(function () {

    Route::get('/user', 'UserController@profile');

    Route::prefix('bank')->group(function () {
        Route::get('services', 'BankController@services')->name('path_bank_service');
        Route::post('store', 'BankController@store')->name('path_bank_store');
        Route::put('update', 'BankController@update')->name('path_bank_update');
        Route::delete('delete', 'BankController@delete')->name('path_bank_delete');
    });

});

Route::post('login', 'LoginController@access');