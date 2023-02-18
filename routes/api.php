<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1', 'middleware' => ['cors']], function () {
    Route::get('/events', 'Api\EventManagement@index');
    Route::get('/organizers/{oslug}/events/{eslug}', 'Api\EventManagement@detail');
    Route::post('/login', 'Api\AttendeeManagement@login');
    Route::post('/register', 'Api\AttendeeManagement@register');
    Route::get('/speakers/{id}', 'Api\SpeakerManagement@show');
    Route::get('/sessions/{id}', 'Api\SessionManagement@show');
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('/refresh', 'Api\AttendeeManagement@refresh');
        Route::post('/logout', 'Api\AttendeeManagement@logout');
        Route::get('/registrations', 'Api\EventManagement@getRegistrations');
        Route::post('/organizers/{oslug}/events/{eslug}/registration', 'Api\EventManagement@registration');
    });
});
