<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;



Route::group([
    'prefix' => 'auth',
    'namespace'=>'Api\Auth'
    ], function ($router) {
       ##backOffice
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('profile', 'AuthController@me');
        Route::post('change-password', 'AuthController@changePassword');
        Route::post('update-profile', 'AuthController@updateProfile');
        Route::post('student-profile-update', 'AuthController@studentUpdateProfile');
         ##backOffice

         Route::post('front-login', 'AuthController@frontLogin');
         Route::post('front-login-otp-check', 'AuthController@frontLoginOtpCheck');

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
