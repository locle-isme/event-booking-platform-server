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
Route::group(['prefix' => 'v1'], function () {
    route::get('/events', 'API\EventManagement@index');
    route::get('/organizers/{oslug}/events/{eslug}', 'API\EventManagement@detail');
    route::post('/organizers/{oslug}/events/{eslug}/registration', 'API\EventManagement@registration');
    route::get('/registrations', 'API\EventManagement@getRegistrations');
    route::post('/login', 'API\AttendeeManagement@login');
    route::post('/logout', 'API\AttendeeManagement@logout');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
