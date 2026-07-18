<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Product Catalog Listing Layout View
Route::get('/products', function () {
    return view('client.products.index');
})->name('products.index');

// Single Product Details Showcase View
Route::get('/products/{id}', function ($id) {
    return view('client.products.show');
})->name('products.show');

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

// Login Views & Processing
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('home'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// Logout Processing
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');


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
    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('products.index');

    Route::get('/products/create', function () {
        return view('admin.products.create');
    })->name('products.create');

    Route::get('/products/{id}/edit', function ($id) {
        return view('admin.products.edit', ['id' => $id]);
    })->name('products.edit');

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
