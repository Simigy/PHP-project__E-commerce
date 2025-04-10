<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CoronaController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoronaDashboardController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\DB;

// Google Login Routes
Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])
    ->name('auth.google')
    ->middleware('guest');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback'])
    ->middleware('guest');

// Public routes
Route::get('/', [UserProductController::class, 'all'])->name('home');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

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
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\CoronaDashboardController::class, 'index'])->name('admin.corona');
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin-products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin-create-product');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin-store-product');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin-edit-product');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin-update-product');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin-delete-product');
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin-users');
    
    // Template routes - for Corona admin template
    Route::get('/template', [App\Http\Controllers\Admin\TemplateController::class, 'dashboard'])->name('admin.template');
    Route::get('/template/buttons', [App\Http\Controllers\Admin\TemplateController::class, 'buttons'])->name('admin.template.buttons');
    Route::get('/template/dropdowns', [App\Http\Controllers\Admin\TemplateController::class, 'dropdowns'])->name('admin.template.dropdowns');
    Route::get('/template/typography', [App\Http\Controllers\Admin\TemplateController::class, 'typography'])->name('admin.template.typography');
    Route::get('/template/form-elements', [App\Http\Controllers\Admin\TemplateController::class, 'formElements'])->name('admin.template.form_elements');
    Route::get('/template/tables', [App\Http\Controllers\Admin\TemplateController::class, 'tables'])->name('admin.template.tables');
    Route::get('/template/charts', [App\Http\Controllers\Admin\TemplateController::class, 'charts'])->name('admin.template.charts');
    Route::get('/template/icons', [App\Http\Controllers\Admin\TemplateController::class, 'icons'])->name('admin.template.icons');
    Route::get('/template/blank', [App\Http\Controllers\Admin\TemplateController::class, 'blankPage'])->name('admin.template.blank');
    Route::get('/template/404', [App\Http\Controllers\Admin\TemplateController::class, 'error404'])->name('admin.template.404');
    Route::get('/template/500', [App\Http\Controllers\Admin\TemplateController::class, 'error500'])->name('admin.template.500');
    Route::get('/template/documentation', [App\Http\Controllers\Admin\TemplateController::class, 'documentation'])->name('admin.template.documentation');

    // Dynamic admin page routes
    Route::prefix('pages')->group(function() {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\PagesController::class, 'dashboard'])->name('admin.pages.dashboard');
        
        // UI Features
        Route::get('/ui-features/buttons', [App\Http\Controllers\Admin\PagesController::class, 'buttons'])->name('admin.pages.buttons');
        Route::get('/ui-features/dropdowns', [App\Http\Controllers\Admin\PagesController::class, 'dropdowns'])->name('admin.pages.dropdowns');
        Route::get('/ui-features/typography', [App\Http\Controllers\Admin\PagesController::class, 'typography'])->name('admin.pages.typography');
        
        // Forms
        Route::get('/forms/basic-elements', [App\Http\Controllers\Admin\PagesController::class, 'basicElements'])->name('admin.pages.forms.basic');
        
        // Tables
        Route::get('/tables/basic-table', [App\Http\Controllers\Admin\PagesController::class, 'basicTable'])->name('admin.pages.tables.basic');
        
        // Charts
        Route::get('/charts/chartjs', [App\Http\Controllers\Admin\PagesController::class, 'chartjs'])->name('admin.pages.charts.chartjs');
        
        // Icons
        Route::get('/icons/mdi', [App\Http\Controllers\Admin\PagesController::class, 'mdi'])->name('admin.pages.icons.mdi');
        
        // Samples
        Route::get('/samples/blank-page', [App\Http\Controllers\Admin\PagesController::class, 'blankPage'])->name('admin.pages.samples.blank');
        Route::get('/samples/error-404', [App\Http\Controllers\Admin\PagesController::class, 'error404'])->name('admin.pages.samples.404');
        Route::get('/samples/error-500', [App\Http\Controllers\Admin\PagesController::class, 'error500'])->name('admin.pages.samples.500');
        Route::get('/samples/login', [App\Http\Controllers\Admin\PagesController::class, 'login'])->name('admin.pages.samples.login');
        Route::get('/samples/register', [App\Http\Controllers\Admin\PagesController::class, 'register'])->name('admin.pages.samples.register');
    });
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
Route::get('/language-switcher', function () {
    return view('language-switcher');
})->name('language.switcher');

// Checkout Routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

// Add this at the top of your routes file to debug the issue
Route::get('/debug-route', function() {
    return [
        'authenticated' => Auth::check(),
        'user' => Auth::user(),
        'session' => session()->all()
    ];
});

Route::get('/check-products', function () {
    return response()->json(DB::table('products')->get());
});

// Product favorite routes
Route::post('/products/{product}/toggle-favorite', [App\Http\Controllers\User\ProductController::class, 'toggleFavorite'])
    ->name('user-toggleFavorite')
    ->middleware('auth');
