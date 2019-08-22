<?php
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', IndexHandler::class)->name('dashboard');
    });
