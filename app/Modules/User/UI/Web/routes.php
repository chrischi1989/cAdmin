<?php
Route::group([
    'prefix'     => 'admin/user',
    'middleware' => [
        'installed',
        'settings'
    ]
], function() {
    Route::get('login', LoginPageHandler::class)->name('user-login-page');
    Route::post('login', LoginHandler::class)->name('user-login');
    Route::get('lost-password', LostPasswordPageHandler::class)->name('user-lost-password-page');
    Route::post('lost-password', LostPasswordHandler::class)->name('user-lost-password');
    Route::get('reset-password/{token}', ResetPasswordPageHandler::class)->name('user-reset-password-page');
    Route::post('reset-password', ResetPasswordHandler::class)->name('user-reset-password');

    Route::group([
        'middleware' => [
            'auth',
            'tenant'
        ]
    ], function () {
        Route::get('/', IndexHandler::class)->name('user-index');
        Route::post('logout', LogoutHandler::class)->name('user-logout');
        Route::get('create', CreateHandler::class)->name('user-create');
        Route::post('store', StoreHandler::class)->name('user-store');
        Route::get('edit/{uuid}', EditHandler::class)->name('user-edit');
        Route::post('update', UpdateHandler::class)->name('user-update');
        Route::post('delete', DeleteHandler::class)->name('user-delete');
        Route::get('profile', ProfilePageHandler::class)->name('user-profile-page');
        Route::post('profile', ProfileHandler::class)->name('user-profile');
    });
});
