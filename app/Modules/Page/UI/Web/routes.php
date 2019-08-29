<?php
Route::group([
    'middleware' => [
        'installed',
        'settings',
        'tenant'
    ]
], function() {
    Route::get('admin', function() { return redirect()->route('user-login-page'); });
    Route::get('{any?}', PageHandler::class);

    Route::group([
        'prefix'     => 'admin/page',
        'middleware' => [
            'auth'
        ]
    ], function() {
        Route::get('/', IndexHandler::class);
    });
});
