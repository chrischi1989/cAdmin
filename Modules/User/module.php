<?php
/** Web Routes */
Route::group([
    'namespace'  => 'Modules\User\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
