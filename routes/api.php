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

Route::middleware('auth:airlock')->group(function () {

    Route::get('/user', 'UserController@profile');

    Route::prefix('bank')->group(function () {
        Route::get('search', 'BankController@search')->name('path_bank_list');
        Route::get('services', 'BankController@services')->name('path_bank_service');
        Route::post('store', 'BankController@store')->name('path_bank_store');
        Route::put('{id}/update', 'BankController@update')->name('path_bank_update');
        Route::delete('{id}/delete', 'BankController@delete')->name('path_bank_delete');
    });

    Route::prefix('business_partner')->group(function () {
        Route::get('search', 'BusinessPartnerController@search')->name('path_business_partner_list');
        Route::post('store', 'BusinessPartnerController@store')->name('path_business_partner_store');
        Route::put('{id}/update', 'BusinessPartnerController@update')->name('path_business_partner_update');
        Route::delete('{id}/delete', 'BusinessPartnerController@delete')->name('path_business_partner_delete');
    });

    Route::prefix('treasury')->group(function () {
        Route::get('search', 'TreasuryController@search')->name('path_treasury_list');
        Route::post('store', 'TreasuryController@store')->name('path_treasury_store');
        Route::put('{id}/update', 'TreasuryController@update')->name('path_treasury_update');
        Route::delete('{id}/delete', 'TreasuryController@delete')->name('path_treasury_delete');
    });

});

Route::post('login', 'LoginController@access');