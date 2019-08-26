<?php
Route::group([
    'prefix' => 'admin/setting',
    'middleware' => [
        'installed',
        'settings',
        'auth'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('setting-index');
});
