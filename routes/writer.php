<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\PlanController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\StripePaymentController;
use App\Http\Controllers\Customer\OrderController;

Route::group(['as'=>'customer.','prefix' =>'customer', 'middleware' => ['auth','customer']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('save-plan', [PlanController::class, 'savePlan'])->name('savePlan');
    Route::post('health-plan-checkout', [PlanController::class, 'healthPlanCheckOut'])->name('healthPlanCheckOut');
    Route::post('health-plan-checkout-store', [PlanController::class, 'healthPlanCheckOutStore'])->name('healthPlanCheckOutStore');
    Route::get('pay-with-stripe', [StripePaymentController::class, 'index'])->name('payWithStripe');
    Route::post('pay-with-stripe', [StripePaymentController::class, 'store'])->name('payWithStripe');
    Route::get('pay-with-cash-in-hand', [PaymentController::class, 'cashInHand'])->name('payWithCashInHand');
    Route::get('my-orders', [OrderController::class, 'index'])->name('orders');
});

