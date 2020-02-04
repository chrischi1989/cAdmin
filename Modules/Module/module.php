<?php
/** Web Routes */
Route::group([
    'namespace'  => 'Modules\Module\UI\Web\Handlers',
    'middleware' => 'web'
], __DIR__ . '/UI/Web/routes.php');
