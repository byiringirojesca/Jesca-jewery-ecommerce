<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Public Client / Customer View Routes
|--------------------------------------------------------------------------
*/

// Homepage Layout View
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::resource('products', ClientProductController::class)->only(['index', 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'destroy'])->name('cart.remove');

    // Checkout Routine Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/confirmation/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes (Native Controllerless Implementation)
|--------------------------------------------------------------------------
*/



Route::middleware('guest')->group(function () {

    // Registration Views & Processing
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);


    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated Session Termination Endpoint
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Back-office Administrative Console Views
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Core Admin Dashboard Overview View
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Inventory Products Management ---
    Route::resource('products', ProductController::class);

    // --- Product Categories Management ---
    Route::get('/categories', function () {
        return view('admin.categories.index');
    })->name('categories.index');

    Route::get('/categories/create', function () {
        return view('admin.categories.create');
    })->name('categories.create');

    Route::get('/categories/edit/{id}', function () {
        return view('admin.categories.edit');
    })->name('categories.create');

    // --- Customer Orders Registry ---
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}/invoice', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');

    // --- System Users Management ---
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::put('/users/{user}/permissions', [UserController::class, 'updatePermissions'])->name('users.update-permissions');
});
