<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\BackendController;
use App\Http\Controllers\frontendController;


require __DIR__.'/auth.php';



Route::get('/', function () {
    return view('welcome');
});

// login and register route
Route::get('admin/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('admin/register', [AdminRegisterController::class, 'register']);
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [frontendController::class, 'index'])->name('dashboard');
    Route::get('product', [frontendController::class, 'product'])->name('product.index');
    Route::get('product/create', [frontendController::class, 'create'])->name('product.create');
    Route::any('/product/store', [frontendController::class, 'store'])->name('product.store');
    Route::get('product/{product}/edit', [frontendController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [frontendController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [frontendController::class, 'destroy'])->name('product.destroy');
    Route::get('product/search', [frontendController::class, 'search'])->name('product.search');
    

    Route::get('/profile/update', [ProfileController::class, 'index'])->name('profile.index');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/update', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/vendor/store', [ProfileController::class, 'store'])->name('store.index');
    Route::put('/vendor/store', [ProfileController::class, 'storeUpdate'])->name('vendor.update');

});

Route::middleware(['admin'])->group(function () {
    // Admin Dashboard route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Cart-related routes for admin
    Route::get('admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
    Route::get('admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('admin/product/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
    // category route
    Route::get('admin/category', [BackendController::class, 'category'])->name('admin.category');
    Route::post('/categories', [BackendController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [BackendController::class, 'update'])->name('categories.update');

    Route::get('admin/profile/update', [BackendController::class, 'profile'])->name('admin.profile.index');
    Route::patch('admin/profile/update', [BackendController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::put('admin/password', [BackendController::class, 'passwordUpdate'])->name('admin.password.update');
    Route::delete('admin/profile/update', [BackendController::class, 'destroy'])->name('admin.profile.destroy');



});
