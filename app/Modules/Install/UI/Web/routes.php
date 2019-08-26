<?php
Route::group(['prefix' => 'install'], function() {
    Route::get('/', SetupHandler::class)->name('setup');
    Route::post('/', InstallHandler::class)->name('install');
});
