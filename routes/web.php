<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'isAuth']], function () {
    Route::resource('events', 'EventController');
    Route::resource('speakers', 'SpeakerController');
    Route::resource('events/{event}/tickets', 'TicketController');
    Route::resource('events/{event}/sessions', 'SessionController');
    Route::resource('events/{event}/channels', 'ChannelController');
    Route::resource('events/{event}/rooms', 'RoomController');
    Route::get('events/{event}/report', 'ReportController@index')->name('report');
    Route::get('/', 'EventController@index')->name('home');
});


Auth::routes();
