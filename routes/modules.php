<?php
Route::group(['prefix' => 'user', 'namespace' => 'User'], app_path('Modules/User/module.php'));
Route::group(['prefix' => 'accesslayer', 'namespace' => 'Accesslayer'], app_path('Modules/Accesslayer/module.php'));
Route::group(['prefix' => 'tenant', 'namespace' => 'Tenant'], app_path('Modules/Tenant/module.php'));
