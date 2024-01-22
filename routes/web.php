<?php

use App\Helpers\Helper;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OnChangeController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\BloodClubController;
use App\Http\Controllers\user\UserController;


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
Route::get('get-district/{id}', [OnChangeController::class,'getDistrict']);
Route::get('get-thana/{id}', [OnChangeController::class,'getThana']);

Auth::routes();
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::   routes();
});


Route::get('/home', [HomeController::class,'home'])->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class,'login'])->name('login');
Route::get('blood-search', [BloodController::class,'search'])->middleware('auth');
Route::get('blood-request', [BloodController::class,'bloodRequest'])->middleware('auth');
Route::post('blood-request', [BloodController::class,'bloodRequestStore'])->middleware('auth');
Route::get('blood-club', [BloodClubController::class,'club'])->middleware('auth');
Route::get('profile-update', [UserController::class,'profile'])->middleware('auth');
Route::patch('profile-update/{id}', [UserController::class,'profileUpdate'])->name('profileUpdate')->middleware('auth');



