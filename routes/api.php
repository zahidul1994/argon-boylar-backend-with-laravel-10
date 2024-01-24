<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;



Route::group([
    'prefix' => 'auth',
    'namespace'=>'Api\Auth'
    ], function ($router) {
       Route::post('register', [AuthController::class, 'register']);
       Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::get('profile', [AuthController::class,'me']);
        Route::post('change-password', [AuthController::class,'changePassword']);
        Route::post('update-profile', [AuthController::class,'updateProfile']);
        
    });


// Frontend api start
Route::group([
    'prefix' => 'api/v1',
    'namespace'=>'V1',
    'middleware' => 'auth',
    ], function () {
       Route::post('course-checkout-store', 'Frontend\AcademicCourseController@courseCheckoutStore');
        Route::post('coupon-check', 'Frontend\CouponController@couponCheck');


        Route::post('course-partial-checkout-store', 'Frontend\AcademicCourseController@coursePartialCheckoutStore');

    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
