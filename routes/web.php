<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Shopping Cart Overview View
Route::get('/cart', function () {
    return view('client.cart.index');
})->name('cart.index');


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
| Protected Checkout Flow (Requires Authentication)
|--------------------------------------------------------------------------
*/

// Checkout Shipping/Billing Form View
Route::get('/checkout', function () {
    return view('client.checkout.index');
})->name('checkout.index');

// Order Confirmation Landing Page View
Route::get('/order-confirmation/{id}', function ($id) {
    return view('client.checkout.confirmation');
})->name('checkout.confirmation');


/*
|--------------------------------------------------------------------------
| Back-office Administrative Console Views
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Core Admin Dashboard Overview View
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

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
    Route::get('/orders', function () {
        return view('admin.orders.index');
    })->name('orders.index');

    Route::get('/orders/{id}', function ($id) {
        return view('admin.orders.show', ['id' => $id]);
    })->name('orders.show');

    // --- System Users Management ---
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
});
