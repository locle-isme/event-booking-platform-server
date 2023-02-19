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
    Route::get('/events', 'Api\EventManagementController@index');
    Route::get('/organizers/{oslug}/events/{eslug}', 'Api\EventManagementController@detail');
    Route::post('/login', 'Api\AttendeeManagementController@login');
    Route::post('/register', 'Api\AttendeeManagementController@register');
    Route::get('/speakers/{id}', 'Api\SpeakerManagementController@show');
    Route::get('/sessions/{id}', 'Api\SessionManagementController@show');
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('/refresh', 'Api\AttendeeManagementController@refresh');
        Route::post('/logout', 'Api\AttendeeManagementController@logout');
        Route::get('/registrations', 'Api\EventManagementController@getRegistrations');
        Route::post('/organizers/{oslug}/events/{eslug}/registration', 'Api\EventManagementController@registration');
    });
});
