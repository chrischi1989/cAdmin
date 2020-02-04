<?php
/** Web Routes */
Route::group([
    'namespace'  => 'Modules\Accesslayer\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
