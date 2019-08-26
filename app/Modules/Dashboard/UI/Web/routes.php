<?php
Route::group([
    'prefix'     => 'admin/dashboard',
    'middleware' => [
        'installed',
        'settings',
        'navigation',
        'auth'
    ],
], function() {
    Route::get('/', IndexHandler::class)->name('dashboard');
});
