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



Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'EventController');
    Route::resource('events/{event}/tickets', 'TicketController');
    Route::resource('events/{event}/sessions', 'SessionController');
    Route::resource('events/{event}/channels', 'ChannelController');
    Route::resource('events/{event}/rooms', 'RoomController');
    Route::get('/', 'EventController@index')->name('home');
});


Auth::routes();
