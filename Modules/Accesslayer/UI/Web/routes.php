<?php
Route::group([
    'prefix'     => 'admin/accesslayer',
    'middleware' => [
        'installed',
        'auth',
        'tenant',
        'settings',
        'navigation'
    ]
], function() {
    Route::get('/', IndexHandler::class)->name('accesslayer-index');
    Route::get('create', CreateHandler::class)->name('accesslayer-create');
    Route::post('store', StoreHandler::class)->name('accesslayer-store');
    Route::get('edit/{uuid}', EditHandler::class)->name('accesslayer-edit');
    Route::post('update', UpdateHandler::class)->name('accesslayer-update');
    Route::post('delete', DestroyHandler::class)->name('accesslayer-destroy');
});
