<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use
    App\Http\Controllers\{ProviderController, BranchController, UserController, DepartmentController, CityController};


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

Route::controller(ProviderController::class)->group(function () {
    Route::post('/providers', 'getAllProviders');
    Route::post('/provider', 'createProvider');
    Route::put('/provider/{id}', 'updateProvider');
    Route::delete('/provider/{id}', 'deleteProvider');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'getAllUsers');
    Route::post('/user', 'createUser');
});

Route::controller(BranchController::class)->group(function () {
    Route::get('/branchs', 'getAllBranchs');
    Route::post('/branch', 'createBranch');
    Route::put('/branch/{id}', 'updateBranch');
    Route::delete('/branch/{id}', 'deleteBranch');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'getAllProducts');
    Route::post('/product', 'createProduct');
    Route::put('/product/{id}', 'updateProduct');
    Route::delete('/product/{id}', 'deleteProduct');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'getAllOrders');
    Route::post('/order', 'createOrder');
    Route::put('/order/{id}', 'updateOrder');
    Route::delete('/order/{id}', 'deleteOrder');
});


Route::controller(DepartmentController::class)->group(function () {
    Route::get('/departments', 'getAllDepartments');
});

Route::controller(CityController::class)->group(function () {
    Route::get('/cities', 'getAllCities');
});