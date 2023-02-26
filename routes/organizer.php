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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'EventController');
    Route::resource('speakers', 'SpeakerController')
        ->only('edit', 'update', 'create', 'store', 'index', 'destroy');
    Route::get('speakers/{speaker}/remove-avatar', 'SpeakerController@removeAvatar')
        ->name('speaker.remove_avatar');
    Route::resource('events/{event}/tickets', 'TicketController')
        ->only('edit', 'update', 'create', 'store', 'destroy');
    Route::resource('events/{event}/sessions', 'SessionController')
        ->only('edit', 'update', 'create', 'store', 'destroy');
    Route::resource('events/{event}/channels', 'ChannelController')
        ->only('edit', 'update', 'create', 'store', 'destroy');
    Route::resource('events/{event}/rooms', 'RoomController')
        ->only('edit', 'update', 'create', 'store', 'destroy');
    Route::get('events/{event}/report', 'ReportController@index')
        ->name('report');
    Route::get('/', 'EventController@index')
        ->name('home');
});


Auth::routes();
