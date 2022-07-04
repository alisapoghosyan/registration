<?php

use App\Http\Controllers\{
    AdminController,
    UserController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/admin/register', [AdminController::class, 'register']);
    Route::post('/admin/blockUser', [AdminController::class, 'blockUser']);
    Route::post('/admin/deleteUser', [AdminController::class, 'deleteUser']);
    Route::post('/admin/activeUser', [AdminController::class, 'activeUser']);
});
