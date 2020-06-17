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

Route::get('/', 'HomeController@index');

    Auth::routes(
        [

            'register' => false,
        ]
    );
// Route::post('/login', 'Auth\\LoginController@authenticate')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/footprint', 'FootprintController@footprint')->name('footprint');
Route::get('/user', 'UserController@user');
Route::get('/marketdata/marketassets', 'MarketDataController@marketassets')->name('marketassets');
Route::get('/marketdata/convert', 'MarketDataController@convert')->name('convert');
Route::get('/marketdata/coincaprates', 'MarketDataController@coincaprates')->name('coincaprates');
Route::get('/marketdata/coincapassethistory', 'MarketDataController@coincapassethistory')->name('coincapassethistory');

Route::get('{path}', "HomeController@index")->where( 'path', '[0-9A-Za-z\-]+' );

