<?php

use App\Helpers\Helper;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubscribeController;
Route::get('storate-link', function () {
    $exitCode = Artisan::call('storage:link');
    return 'store link folder create';
});
Route::get('clear-cache', function () {
    $exitCode = Artisan::call('optimize:clear');
    return 'cache clear';
});
Route::fallback(function () {
    abort(404);
});
Route::get('migrate', function () {
    Artisan::call(
        'migrate',
        array(
          '--path' => 'database/migrations',
          '--database' => 'mysql',
          '--force' => true
        )
      );
    return 'migrate done';
});

Route::get('dbseed', function () {
    Artisan::call('db:seed');
    return 'Seeding done';
});

Route::get('/', [HomeController::class,'index']);
Route::get('/main', [HomeController::class,'main']);

Auth::routes();
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::   routes();
});


Route::get('/home', [HomeController::class,'index'])->name('home');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





