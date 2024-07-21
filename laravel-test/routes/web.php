<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckCustomerHasOrders;

Route::get('/', function () {
    return view('welcome');
});

Route::get('no-orders', function () {
    return "Customer has no orders.";
});

Route::get('customer/{customer}/profile', function ($customerId) {
    return "Welcome to the profile of customer with ID: $customerId";
})->middleware(CheckCustomerHasOrders::class);
