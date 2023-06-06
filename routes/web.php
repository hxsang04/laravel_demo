<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Backend Route
Route::prefix('admin')->middleware('auth:admin')->group(function(){

    Route::prefix('/product')->group(function(){

        Route::get('', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/create', [ProductController::class, 'store'])->name('product.store');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/edit/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::post('/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
        Route::post('/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
        Route::post('/remove/{id}', [ProductController::class, 'remove'])->name('product.remove');
        Route::post('/import', [ProductController::class, 'import'])->name('product.import');
        Route::get('/export', [ProductController::class, 'export'])->name('product.export');
        Route::get('/search', [ProductController::class, 'search'])->name('product.search');

    });

    Route::prefix('/order')->group(function(){
        Route::get('', [OrderController::class, 'index'])->name('order.index');
        Route::get('/show/{order}', [OrderController::class, 'show'])->name('order.show');
    });
    Route::prefix('/user')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
        Route::post('/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
        Route::post('/restore/{id}', [UserController::class, 'restore'])->name('user.restore');

    });

   
});
Route::middleware('admin:admin')->group( function (){
    Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('admin/login', [AuthController::class, 'store'])->name('admin.loginPost');
    Route::post('admin/logout', [AuthController::class, 'destroy'])->name('admin.logout');
});

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:admin');
});

//Frontend Route


Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{product}', [ShopController::class, 'product'])->name('product');
Route::get('/order-history', [ShopController::class, 'orderHistory'])->middleware('auth')->name('orderHistory');
Route::get('/order-history/{order}', [ShopController::class, 'orderHistoryDetail'])->middleware('auth')->name('orderHistoryDetail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/checkout', [CheckOutController::class, 'checkOut'])->middleware('auth')->name('checkOut');
Route::post('/checkout', [CheckOutController::class, 'checkOutPost'])->middleware('auth')->name('checkOutPost');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
