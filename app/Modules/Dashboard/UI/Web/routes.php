<?php
Route::group([
    'prefix'     => 'admin/dashboard',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ],
], function() {
    Route::get('/', IndexHandler::class)->name('dashboard');
});
