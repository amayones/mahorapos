<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\UserController      as OwnerUser;
use App\Http\Controllers\Owner\ProductController   as OwnerProduct;
use App\Http\Controllers\Owner\ReportController    as OwnerReport;
use App\Http\Controllers\Owner\CouponController    as OwnerCoupon;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboard;
use App\Http\Controllers\Cashier\PosController;
use App\Http\Controllers\Cashier\ShiftController;
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

    Route::get('/products',              [OwnerProduct::class, 'index'])->name('owner.products');
    Route::post('/products',             [OwnerProduct::class, 'store'])->name('owner.products.store');
    Route::get('/products/{product}/edit', [OwnerProduct::class, 'edit'])->name('owner.products.edit');
    Route::put('/products/{product}',    [OwnerProduct::class, 'update'])->name('owner.products.update');
    Route::delete('/products/{product}', [OwnerProduct::class, 'destroy'])->name('owner.products.destroy');

    Route::get('/users',            [OwnerUser::class, 'index'])->name('owner.users');
    Route::post('/users',           [OwnerUser::class, 'store'])->name('owner.users.store');
    Route::delete('/users/{user}',  [OwnerUser::class, 'destroy'])->name('owner.users.destroy');

    Route::get('/reports',               [OwnerReport::class,    'index'])->name('owner.reports');
    Route::get('/reports/{transaction}',  [OwnerReport::class,    'show'])->name('owner.reports.show');

    Route::get('/coupons',               [OwnerCoupon::class, 'index'])->name('owner.coupons');
    Route::post('/coupons',              [OwnerCoupon::class, 'store'])->name('owner.coupons.store');
    Route::patch('/coupons/{coupon}/toggle', [OwnerCoupon::class, 'toggle'])->name('owner.coupons.toggle');
    Route::delete('/coupons/{coupon}',   [OwnerCoupon::class, 'destroy'])->name('owner.coupons.destroy');
});

// Cashier
Route::prefix('cashier')->middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/dashboard',         [CashierDashboard::class, 'index'])->name('cashier.dashboard');
    Route::get('/pos',               [PosController::class,    'index'])->name('cashier.pos');
    Route::post('/pos/checkout',     [PosController::class,    'checkout'])->name('cashier.pos.checkout');
    Route::post('/pos/validate-coupon', [PosController::class, 'validateCoupon'])->name('cashier.pos.validate-coupon');
    Route::get('/history',           [PosController::class,    'history'])->name('cashier.history');
    Route::post('/refund/{transaction}', [PosController::class, 'refund'])->name('cashier.refund');
    Route::get('/shift',             [ShiftController::class,  'index'])->name('cashier.shift');
    Route::post('/shift/open',       [ShiftController::class,  'open'])->name('cashier.shift.open');
    Route::post('/shift/close',      [ShiftController::class,  'close'])->name('cashier.shift.close');
});

// Staff
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard',                        [StaffDashboard::class,    'index'])->name('staff.dashboard');
    Route::get('/inventory',                        [InventoryController::class, 'index'])->name('staff.inventory');
    Route::patch('/inventory/{product}/stock',      [InventoryController::class, 'updateStock'])->name('staff.inventory.stock');
});

// Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',     [AdminDashboard::class,      'index'])->name('admin.dashboard');

    Route::get('/shops',                        [ShopController::class, 'index'])->name('admin.shops');
    Route::patch('/shops/{shop}/activate',      [ShopController::class, 'activate'])->name('admin.shops.activate');
    Route::patch('/shops/{shop}/suspend',       [ShopController::class, 'suspend'])->name('admin.shops.suspend');
    Route::delete('/shops/{shop}',              [ShopController::class, 'destroy'])->name('admin.shops.destroy');

    Route::get('/subscriptions',                        [SubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::patch('/subscriptions/{shop}/extend',        [SubscriptionController::class, 'extend'])->name('admin.subscriptions.extend');
});
