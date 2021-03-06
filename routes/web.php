<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('pw/{length?}', function($length = 12) { return \App\Helpers::generatePassword($length); });
Route::get('hash/{value}', function($value) { return Hash::make($value); });
Route::get('uuid', function() { return \Ramsey\Uuid\Uuid::uuid4(); });
Route::get('enc/{value}', function($value) { return encrypt($value); });
Route::get('dec/{value}', function($value) { return decrypt($value); });
