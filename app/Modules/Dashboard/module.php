<?php
/** Web Routes */
Route::group([
    'namespace'  => 'psnXT\Modules\Dashboard\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
