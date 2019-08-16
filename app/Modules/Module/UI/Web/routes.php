<?php
    Route::get('/', IndexHandler::class)->name('module-index');
    Route::get('create', CreateHandler::class)->name('module-create');
    Route::post('store', StoreHandler::class)->name('module-store');
    Route::get('edit/{uuid}', EditHandler::class)->name('module-edit');
    Route::post('update', UpdateHandler::class)->name('module-update');
    Route::post('delete', DeleteHandler::class)->name('module-delete');

