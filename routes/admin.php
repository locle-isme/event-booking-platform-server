<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('login');
    Route::middleware('auth:admin')->group(function () {
        Route::get('', 'Admin\OrganizerController@index')->name('home');
        Route::get('organizer/{organizer}/edit', 'Admin\OrganizerController@edit')
            ->name('organizer.edit');
        Route::put('organizer/{organizer}/edit', 'Admin\OrganizerController@update')
            ->name('organizer.update');
        Route::get('organizer/create', 'Admin\OrganizerController@create')
                    ->name('organizer.create');
        Route::post('organizer/create', 'Admin\OrganizerController@store')
            ->name('organizer.store');
        Route::get('organizer/{organizer}/force-login', 'Admin\OrganizerController@forceLogin')
                    ->name('organizer.force_login');
        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');
    });
});
