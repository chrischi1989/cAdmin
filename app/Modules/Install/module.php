<?php
/** Web Routes */
Route::group([
    'namespace'  => 'psnXT\Modules\Install\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
