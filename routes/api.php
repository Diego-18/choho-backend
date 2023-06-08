<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use
    App\Http\Controllers\{
        CustomerController,
        BranchController,
        UserController,
        DepartmentController,
        CityController,
        ProductController,
        OrderController,
    };


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(CustomerController::class)->group(function () {
    Route::post('/customers', 'getAllCustomers')->middleware('auth:sanctum');
    Route::post('/customer', 'createCustomer')->middleware('auth:sanctum');
    Route::put('/customer/{id}', 'updateCustomer')->middleware('auth:sanctum');
    Route::delete('/customer/{id}', 'deleteCustomer')->middleware('auth:sanctum');
});

// Route::controller(UserController::class)->group(function () {
//     Route::get('/users', 'getAllUsers');
//     Route::post('/user', 'createUser');
// });

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'logIn');
    Route::post('/logout', 'logOut');
    Route::get('/user', 'me')->middleware('auth:sanctum');
});

Route::controller(BranchController::class)->group(function () {
    Route::post('/branches', 'getAllBranchs')->middleware('auth:sanctum');
    Route::post('/branch', 'createBranch')->middleware('auth:sanctum');
    Route::put('/branch/{id}', 'updateBranch')->middleware('auth:sanctum');
    Route::delete('/branch/{id}', 'deleteBranch')->middleware('auth:sanctum');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/products', 'getAllProducts')->middleware('auth:sanctum');
    Route::post('/product', 'createProduct')->middleware('auth:sanctum');
    Route::put('/product/{id}', 'updateProduct')->middleware('auth:sanctum');
    Route::delete('/product/{id}', 'deleteProduct')->middleware('auth:sanctum');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('/orders', 'getAllOrders')->middleware('auth:sanctum');
    Route::post('/order', 'createOrder')->middleware('auth:sanctum');
    Route::put('/order/{id}', 'updateOrder')->middleware('auth:sanctum');
    Route::delete('/order/{id}', 'deleteOrder')->middleware('auth:sanctum');
});


Route::controller(DepartmentController::class)->group(function () {
    Route::post('/departments', 'getAllDepartments')->middleware('auth:sanctum');
});

Route::controller(CityController::class)->group(function () {
    Route::post('/cities', 'getAllCities')->middleware('auth:sanctum');
});