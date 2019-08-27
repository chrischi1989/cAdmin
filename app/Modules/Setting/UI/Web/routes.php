<?php
Route::group([
    'prefix' => 'admin/setting',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('setting-index');
});
