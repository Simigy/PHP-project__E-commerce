<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(ApiProductController::class)->group(function () {
    Route::middleware('api_auth')->group(function () {

        Route::get('products', 'index')->name('all-products');
        Route::get('product/show/{id}', 'show')->name('show-product');
        // Create
        Route::get('product/create', 'create')->name('create-product');
        Route::post('products', 'store')->name('store-product');
        // Edit
        Route::get('product/edit/{id}', 'edit')->name('edit-product');
        Route::put('product/{id}', 'update')->name('update-product');
        // delete
        Route::delete('product/{id}', 'delete')->name('delete-product');
    });
});
Route::controller(ApiAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});
