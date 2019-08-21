<?php
Route::group(['prefix' => 'install', 'namespace' => 'Install'], app_path('Modules/Install/module.php'));
Route::group(['middleware' => ['installed', 'settings']], function() {
    Route::group(['prefix' => 'module', 'namespace' => 'Module'], app_path('Modules/Module/module.php'));
    Route::group(['prefix' => 'navigation', 'namespace' => 'Navigation'], app_path('Modules/Navigation/module.php'));
    Route::group(['prefix' => 'user', 'namespace' => 'User'], app_path('Modules/User/module.php'));
    Route::group(['prefix' => 'accesslayer', 'namespace' => 'Accesslayer'], app_path('Modules/Accesslayer/module.php'));
    Route::group(['prefix' => 'tenant', 'namespace' => 'Tenant'], app_path('Modules/Tenant/module.php'));
    Route::group(['prefix' => 'setting', 'namespace' => 'Setting'], app_path('Modules/Setting/module.php'));
});
