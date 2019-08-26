<?php
Route::group([
    'prefix'     => 'admin/navigation',
    'middleware' => [
        'installed',
        'settings',
        'auth'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('navigation-index');
});
