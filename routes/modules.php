<?php
Route::group(['namespace' => 'Page'], app_path('Modules/Page/module.php'));
Route::group(['namespace' => 'Install'], app_path('Modules/Install/module.php'));
Route::group(['namespace' => 'Dashboard'], app_path('Modules/Dashboard/module.php'));
Route::group(['namespace' => 'Tenant'], app_path('Modules/Tenant/module.php'));
Route::group(['namespace' => 'User'], app_path('Modules/User/module.php'));
Route::group(['namespace' => 'Accesslayer'], app_path('Modules/Accesslayer/module.php'));
Route::group(['namespace' => 'Module'], app_path('Modules/Module/module.php'));
Route::group(['namespace' => 'Navigation'], app_path('Modules/Navigation/module.php'));
Route::group(['namespace' => 'Setting'], app_path('Modules/Setting/module.php'));
