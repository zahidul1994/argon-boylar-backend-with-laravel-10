<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;

Route::group(['as'=>'superadmin.','prefix' =>'superadmin', 'middleware' => ['auth', 'superadmin']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
  //common
  include __DIR__ . '/common.php';
});


