<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoronaDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

// Public routes
Route::get('/', [UserProductController::class, 'all'])->name('home');

// Auth routes
Route::get('redirect', [AuthController::class, 'redirect'])
    ->name('redirect')
    ->middleware(['web']);

Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware(['web']);

// Language switcher route
Route::get("change/{lang}", function ($lang) {
    if ($lang == 'en') {
        session()->put('lang', 'en');
    } else {
        session()->put('lang', 'ar');
    }
    return redirect()->back();
});

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    // Dashboard routes
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Product management routes
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names([
        'index' => 'admin-all-products',
        'create' => 'admin-create-product',
        'store' => 'admin-store-product',
        'edit' => 'admin-edit-product',
        'update' => 'admin-update-product',
        'destroy' => 'admin-delete-product',
    ]);

    // Profile routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/settings', [App\Http\Controllers\Admin\ProfileController::class, 'settings'])->name('admin.settings');
    Route::post('/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/settings/update', [App\Http\Controllers\Admin\ProfileController::class, 'updateSettings'])->name('admin.settings.update');
});

// User routes
Route::controller(UserProductController::class)->group(function () {
    // Public routes
    Route::get("products", "all")->name("user-all-products");
    Route::get('product/show/{id}', 'show')->name('user-show-product');
    Route::post('product/addToWhishlist/{id}', 'addToWhishlist')->name('user-addToWhishlist');
    Route::get('product/myWhishlist', 'myWhishlist')->name('user-myWhishlist');
    Route::post('product/removeFromWhishlist/{id}', 'removeFromWhishlist')->name('user-removeFromWhishlist');
    Route::post('product/clearWhishlist', 'clearWhishlist')->name('user-clearWhishlist');

    // Protected routes
    Route::middleware("auth")->group(function () {
        Route::post('product/addToCart/{id}', 'addToCart')->name('user-addToCart');
        Route::get('product/showCart', 'showCart')->name('user-showCart');
        Route::post('product/removeFromCart/{id}', 'removeFromCart')->name('user-removeFromCart');
        Route::post('product/clearCart', 'clearCart')->name('user-clearCart');
        Route::post("makeOrder", "makeOrder")->name("makeOrder");
        Route::post("addToFavorite/{id}", "addToFavorite")->name("addToFavorite");
    });
});

// Order routes
Route::controller(\App\Http\Controllers\User\OrderController::class)->group(function () {
    Route::middleware("auth")->group(function () {
        Route::get('orders', 'index')->name('user-orders');
        Route::get('orders/{id}', 'show')->name('user-show-order');
    });
});

// Language Switcher Route
Route::get('language/{lang}', [App\Http\Controllers\Admin\LanguageController::class, 'switchLang'])->name('language.switch');

// Dedicated language switcher page
Route::get('/language-switcher', function() {
    return view('language-switcher');
})->name('language.switcher');
