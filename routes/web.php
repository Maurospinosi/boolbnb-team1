<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// ?
Auth::routes();
// Rotte per l'host
Route::prefix('host')->name('host/')->namespace('Host')->middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/info/{id}', 'UserInfoController@show')->name('info/show');
    Route::get('/register', 'UserInfoController@create')->name('info/create');
    Route::post('/info', 'UserInfoController@store')->name('info/store');
    Route::resource('/house', 'HouseController');
    Route::resource('/message', 'MessageController');

    Route::resource('/house', 'HouseController');

    Route::get('/house/{id}/statistic', 'StatisticController@index')->name('house/statistic');

    Route::get('/sponsorship', 'PaymentsController@index')->name('sponsorship');
    Route::get('/sponsorship/payment', "PaymentsController@pay")->name('payment');
});
// Rotte per il guest
Route::name('guest/')->namespace('Guest')->group(function () {
    Route::get('/', 'GuestHouseController@index')->name('home');
    Route::get('house/{slug}', 'GuestHouseController@show')->name('house');
    Route::get('search', 'SearchController@index')->name('search');
    Route::post('/message', 'MessageController@store')->name('message.store');
});