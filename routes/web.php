<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\LayananController as CustomerLayananController;
use App\Http\Controllers\Customer\PembayaranController as CustomerPembayaranController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;

 /*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  */

 // Home route
 Route::get('/', [HomeController::class, 'index'])->name('home');

 // Authentication routes
 Route::middleware('guest')->group(function () {
     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
     Route::post('/login', [LoginController::class, 'login']);
     Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
     Route::post('/register', [RegisterController::class, 'register']);
 });

 Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

 // Admin routes
 Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

     // Services management
     Route::resource('services', AdminServiceController::class);

     // Orders management
     Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
     Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
     Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
     Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

     // Customers management
     Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
     Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');

     // Pembayaran management untuk admin
     Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
     Route::get('/pembayaran/{pembayaran}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');
     Route::put('/pembayaran/{pembayaran}/status', [AdminPembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
 });

 // Customer routes
 Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
     Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

     // Orders
     Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
     Route::get('/orders/create', [CustomerOrderController::class, 'create'])->name('orders.create');
     Route::post('/orders', [CustomerOrderController::class, 'store'])->name('orders.store');
     Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
    Route::delete('/customer/orders/{order}', [CustomerOrderController::class, 'destroy'])->name('orders.destroy');



     // Layanan
     Route::get('/layanan', [CustomerLayananController::class, 'index'])->name('layanan.index');

    //  // Pembayaran (sesuai total pesanan)
    //  // Form create pembayaran untuk pesanan tertentu
    //  Route::get('/pembayaran/{pesanan}', [CustomerPembayaranController::class, 'create'])->name('pembayaran.create');
    //  // Submit data pembayaran
    //  Route::post('/pembayaran', [CustomerPembayaranController::class, 'store'])->name('pembayaran.store');

     // Profile
     Route::get('/profile/edit', [CustomerProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');

   
    Route::get('pembayaran/{id}', [CustomerPembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('pembayaran', [CustomerPembayaranController::class, 'store'])->name('pembayaran.store');

    Route::post('bayar/{orderId}', [CustomerPembayaranController::class, 'bayar'])->name('bayar');

    Route::get('/pembayaran/finish', [CustomerPembayaranController::class, 'finish'])->name('pembayaran.finish');
Route::get('/pembayaran/unfinish', [CustomerPembayaranController::class, 'unfinish'])->name('pembayaran.unfinish');
Route::get('/pembayaran/error', [CustomerPembayaranController::class, 'error'])->name('pembayaran.error');


 });
