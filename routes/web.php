<?php

use App\Mail\NewUser;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $titlename = 'Home';
    if(Auth::guest()){
    return redirect(route('viewLogin'));
    } else {
        return redirect(route('dashboard'));
    }
})->name('home');

Route::get('/login', function () {
    return redirect(route('viewLogin'));
})->name('login');

Route::get('/dashboard', function () {
    return redirect(route('dashboard'));
})->name('dash');

Route::get('/search/{query}', [SearchController::class, 'search']);

Route::group(['prefix' => 'auth'], function () {
    // Show dashboard index
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // view Register form
    Route::get('/register', [UserController::class, 'create'])->name('registration');

    // Store user data
    Route::post('/store', [UserController::class, 'store'])->name('register');

    // Login Page
    Route::get('/login', [AuthController::class, 'index'])->name('viewLogin');

    // Logout Page
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    // Show dashboard users
    Route::get('/users', [UserController::class, 'index'])->name('users');

    // Show users
    Route::get('/users/{id}', [UserController::class, 'show'])->name('show_user');

    // Edit user
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit_user');

    // Update user
    Route::post('/users/{user}/update', [UserController::class, 'update'])->name('update_user');

    // Show create orders
    Route::get('/orders/create', [OrderController::class, 'create'])->name('create_orders');

    // Show create orders
    Route::get('/orders/create/mobile', [OrderController::class, 'createMobile'])->name('create_orders_mobile');

    // Show created orders
    Route::get('/orders/created/mobile', [OrderController::class, 'createdMobile'])->name('created_orders_mobile');

    // Store orders
    Route::post('/orders/store', [OrderController::class, 'store'])->name('store_order');

    // Store orders
    Route::post('/orders/store/mobile', [OrderController::class, 'storeMobile'])->name('store_order_mobile');

    // Edit orders
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('edit_order');

    // Update orders
    Route::put('/orders/{order}/update', [OrderController::class, 'update'])->name('update_order');

    // Update orders status
    Route::put('/orders/{order}/update/status', [OrderController::class, 'updateStatus'])->name('update_order_status');

    // Update orders status
    Route::put('/orders/{order}/update/note', [OrderController::class, 'updateNote'])->name('update_order_note');

    // Delete orders
    Route::get('/orders/{order}/delete', [OrderController::class, 'destroy'])->name('delete_order');

    // Show dashboard orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    // Show dashboard single order
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('showOrder');

    // Show create products
    Route::get('/products/create', [ProductController::class, 'create'])->name('create_products');

    // Store products
    Route::post('/products/store', [ProductController::class, 'store'])->name('storeProduct');

    // Edit products
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('editProduct');

    // Update products
    Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('updateProduct');

    // Delete product
    // Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('deleteProduct');

    // Show dashboard products
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    // Show dashboard Leads
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');

    // Store Leads
    Route::post('/leads/store', [LeadController::class, 'store'])->name('place_order');

    // Claim Leads
    Route::post('/leads/{lead}/claim', [LeadController::class, 'update'])->name('claim');

    // Lead Generated
    Route::get('/leads/created', [LeadController::class, 'created'])->name('lead_created');

    // Personal Profile Page
    Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('own_profile');

    // payment index
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');

    // Create payment
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('create_payments');

    // Store payment
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('store_payments');
});


// Authenticate users
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authentication');

// View Result
Route::get('/result', [ResultController::class, 'index'])->name('result');

// View Result
Route::get('/result2', [ResultController::class, 'index2'])->name('result2');

// Calculate Result
Route::post('/calculate', [ResultController::class, 'calculate'])->name('calculate');

// Subscribe for NewsLetter
Route::post('/subscribe', [SubscribeController::class, 'create'])->name('subscribe');

// Subscribed for NewsLetter
Route::get('/subscribed', [SubscribeController::class, 'done'])->name('subscribed');

Route::get('/demo', function () {
    $titlename = "Demo";
    $username = "Username";
    $password = "Password";

    $orderNumber = 0001;
    $name = 'Sumin Shrestha';
    $phone = '+977 9817208300';
    $address = 'Dallu Awas';
    $product = 'Meal replacement drink';
    $total_price = 3600;
    $user = 'Sumin Shrestha';
    // return new NewOrder($name, $phone, $address, $orderNumber, $product, $total_price, $user);
    // return new NewUser($username, $password);
    return view('orderplaced', compact('titlename'));
});
