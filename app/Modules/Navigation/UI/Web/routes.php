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
    Route::get('create', CreateHandler::class)->name('navigation-create');
    Route::post('store', StoreHandler::class)->name('navigation-store');
    Route::get('edit/{uuid}', EditHandler::class)->name('navigation-edit');
    Route::post('update', UpdateHandler::class)->name('navigation-update');
    Route::post('destroy', DestroyHandler::class)->name('navigation-destroy');
    Route::post('xhr/sort', SortHandler::class)->name('navigation-sort');
});
