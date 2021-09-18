<?php

use Illuminate\Http\Request;

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
Route::group(['prefix' => 'v1', 'middleware' => ['cors']], function () {
    route::get('/events', 'Api\EventManagement@index');
    route::get('/organizers/{oslug}/events/{eslug}', 'Api\EventManagement@detail');
    route::post('/organizers/{oslug}/events/{eslug}/registration', 'Api\EventManagement@registration');
    route::get('/registrations', 'Api\EventManagement@getRegistrations');
    route::post('/login', 'Api\AttendeeManagement@login');
    route::post('/register', 'Api\AttendeeManagement@register');
    route::get('/logout', 'Api\AttendeeManagement@logout');
    route::get('/speakers/{id}', 'Api\SpeakerManagement@show');
    route::get('/sessions/{id}', 'Api\SessionManagement@show');
});
