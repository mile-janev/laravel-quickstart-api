<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\User\RoleController;
use App\Http\Controllers\Api\v1\User\UserController;

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

Route::middleware("localization")->group(function () {

	Route::post('user/register', [AuthController::class, 'register'])->name('user.register');
	Route::post('user/login', [AuthController::class, 'login'])->name('user.login');

	Route::middleware('auth:api')->group(function () {
		Route::post('user/logout', [AuthController::class, 'logout'])->name('user.logout');
		Route::post('user/logout-all-devices', [AuthController::class, 'logoutAllDevices'])->name('user.logoutAllDevices');
		Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
		Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
	});
});
