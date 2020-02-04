<?php
Route::group([
    'prefix' => 'admin/module',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('module-index');
    Route::get('create', CreateHandler::class)->name('module-create');
    Route::post('store', StoreHandler::class)->name('module-store');
    Route::get('edit/{uuid}', EditHandler::class)->name('module-edit');
    Route::post('update', UpdateHandler::class)->name('module-update');
    Route::post('delete', DeleteHandler::class)->name('module-destroy');
});
