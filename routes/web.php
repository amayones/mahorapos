<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\UserController      as OwnerUser;
use App\Http\Controllers\Owner\ProductController   as OwnerProduct;
use App\Http\Controllers\Owner\ReportController    as OwnerReport;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboard;
use App\Http\Controllers\Cashier\PosController;
use App\Http\Controllers\Staff\DashboardController   as StaffDashboard;
use App\Http\Controllers\Staff\InventoryController;
use App\Http\Controllers\Admin\DashboardController   as AdminDashboard;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\SubscriptionController;

// Public
Route::get('/', fn() => view('landing.index'));

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Owner
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('owner.dashboard');
    Route::get('/users',     [OwnerUser::class,      'index'])->name('owner.users');
    Route::get('/products',  [OwnerProduct::class,   'index'])->name('owner.products');
    Route::get('/reports',   [OwnerReport::class,    'index'])->name('owner.reports');
});

// Cashier
Route::prefix('cashier')->middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/dashboard', [CashierDashboard::class, 'index'])->name('cashier.dashboard');
    Route::get('/pos',       [PosController::class,    'index'])->name('cashier.pos');
});

// Staff
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [StaffDashboard::class,   'index'])->name('staff.dashboard');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('staff.inventory');
});

// Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',     [AdminDashboard::class,      'index'])->name('admin.dashboard');
    Route::get('/shops',         [ShopController::class,      'index'])->name('admin.shops');
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
});
