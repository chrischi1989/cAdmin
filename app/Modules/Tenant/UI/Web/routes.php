<?php
Route::group([
    'prefix'     => 'admin/tenant',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('tenant-index');
    Route::get('create', CreateHandler::class)->name('tenant-create');
    Route::post('store', StoreHandler::class)->name('tenant-store');
    Route::get('edit/{uuid}', EditHandler::class)->name('tenant-edit');
    Route::post('update', UpdateHandler::class)->name('tenant-update');
    Route::post('delete', DeleteHandler::class)->name('tenant-delete');
});
