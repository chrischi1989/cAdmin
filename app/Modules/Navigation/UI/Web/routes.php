<?php
Route::group([
    'prefix'     => 'admin/navigation',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('navigation-index');
});
