<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentDetailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);

    // Branch routes
    Route::post('/branch', [BranchController::class, 'createBranch']);
    Route::get('/branches', [BranchController::class, 'getAllBranches']);
    Route::get('/branch', [BranchController::class, 'getBranch']);
    Route::put('/branch', [BranchController::class, 'updateBranch']);
    Route::delete('/branch', [BranchController::class, 'deleteBranch']);

    // Employee routes
    Route::post('/employee', [EmployeeController::class, 'createEmployee']);
    Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
    Route::get('/employee', [EmployeeController::class, 'getEmployee']);
    Route::put('/employee', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/employee', [EmployeeController::class, 'deleteEmployee']);

    // Role routes
    Route::post('/role', [RoleController::class, 'createRole']);
    Route::get('/roles', [RoleController::class, 'getAllRoles']);
    Route::get('/role', [RoleController::class, 'getRole']);
    Route::put('/role', [RoleController::class, 'updateRole']);
    Route::delete('/role', [RoleController::class, 'deleteRole']);

    // Customer routes
    Route::post('/customer', [CustomerController::class, 'createCustomer']);
    Route::get('/customers', [CustomerController::class, 'getAllCustomers']);
    Route::get('/customer', [CustomerController::class, 'getCustomer']);
    Route::put('/customer', [CustomerController::class, 'updateCustomer']);
    Route::delete('/customer', [CustomerController::class, 'deleteCustomer']);

    // Product routes
    Route::post('/product', [ProductController::class, 'createProduct']);
    Route::get('/products', [ProductController::class, 'getAllProducts']);
    Route::get('/product', [ProductController::class, 'getProduct']);
    Route::put('/product', [ProductController::class, 'updateProduct']);
    Route::delete('/product', [ProductController::class, 'deleteProduct']);

    // Payment routes
    Route::post('/payment', [PaymentController::class, 'createPayment']);
    Route::get('/payments', [PaymentController::class, 'getAllPayments']);
    Route::get('/payment', [PaymentController::class, 'getPayment']);
    Route::put('/payment', [PaymentController::class, 'updatePayment']);
    Route::delete('/payment', [PaymentController::class, 'deletePayment']);

    // Payment Detail routes
    Route::post('/paymentDetail', [PaymentDetailController::class, 'createPaymentDetail']);
    Route::get('/paymentDetails', [PaymentDetailController::class, 'getAllPaymentDetails']);
    Route::get('/paymentDetail', [PaymentDetailController::class, 'getPaymentDetail']);
    Route::put('/paymentDetail', [PaymentDetailController::class, 'updatePaymentDetail']);
    Route::delete('/paymentDetail', [PaymentDetailController::class, 'deletePaymentDetail']);
});

Route::middleware('web')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});
