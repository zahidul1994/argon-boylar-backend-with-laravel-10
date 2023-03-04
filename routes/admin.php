<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::group([
  'as' => 'admin.',
  'prefix' => 'admin',
  'middleware' => ['auth', 'admin']
], function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  //common
  include __DIR__ . '/common.php';
});
