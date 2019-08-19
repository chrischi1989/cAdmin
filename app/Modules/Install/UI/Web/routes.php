<?php
    Route::get('/', SetupHandler::class)->name('setup');
    Route::post('/', InstallHandler::class)->name('install');

