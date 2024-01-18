<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\RoleController;
use App\Http\Controllers\Common\UserController;
use App\Http\Controllers\Common\SettingController;
use App\Http\Controllers\Common\ClubController;
use App\Http\Controllers\Common\BlogController;
use App\Http\Controllers\Common\CategoryController;

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::post('user-status', [UserController::class, 'updateStatus'])->name('userStatus');


##user end
Route::resource('setting', SettingController::class);
Route::resource('clubs', ClubController::class);
Route::post('club-status', [ClubController::class, 'updateStatus'])->name('clubStatus');

##caregory 
Route::resource('categories', CategoryController::class);
Route::post('category-status', [CategoryController::class, 'updateStatus'])->name('categoryStatus');


##blog end
Route::resource('blogs', BlogController::class);
Route::post('blog-status', [BlogController::class, 'updateStatus'])->name('blogStatus');
