<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\RoleController;
use App\Http\Controllers\Common\UserController;
use App\Http\Controllers\Common\SettingController;
use App\Http\Controllers\Common\ClubController;

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::post('user-status', [UserController::class, 'updateStatus'])->name('userStatus');

##user end
Route::resource('setting', SettingController::class);
Route::resource('clubs', ClubController::class);

