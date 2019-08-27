<?php
/** Web Routes */
Route::group([
    'namespace'  => 'psnXT\Modules\Page\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
