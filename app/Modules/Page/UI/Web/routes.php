<?php
Route::group([
    'middleware' => [
        'installed',
        'settings'
    ]
], function() {
    Route::get('admin', function() { return redirect()->route('user-login-page'); });
    Route::get('{any?}', PageHandler::class);

    Route::group([
        'prefix'     => 'admin/page',
        'middleware' => [
            'tenant',
            'auth'
        ]
    ], function() {
        Route::get('/', IndexHandler::class);
    });
});
