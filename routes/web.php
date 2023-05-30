<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
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
Route::prefix('admin')->group(function(){

    // Route::get('/login', [AuthController::class, 'login']);

    Route::prefix('/product')->group(function(){

        Route::get('', [ProductController::class, 'index']);
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/create', [ProductController::class, 'store']);
        Route::get('/detail/{product}', [ProductController::class, 'show']);
        Route::get('/edit/{product}', [ProductController::class, 'edit']);
        Route::post('/edit/{product}', [ProductController::class, 'update']);
        Route::post('/delete/{product}', [ProductController::class, 'destroy']);
        Route::get('/trashed', [ProductController::class, 'trashed']);
        Route::post('/restore/{id}', [ProductController::class, 'restore']);
        Route::post('/remove/{id}', [ProductController::class, 'remove']);

    });

    Route::prefix('/order')->group(function(){
        Route::get('', [OrderController::class, 'index']);
        Route::get('/detail/{order}', [OrderController::class, 'show'])->name('order.detail');
    });

   
});

//Frontend Route

Route::get('', function(){
    return view('frontend.index');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product}', [ShopController::class, 'product'])->name('product');
Route::get('/order-history', [ShopController::class, 'orderHistory'])->name('orderHistory');
Route::get('/order-history/{order}', [ShopController::class, 'orderHistoryDetail'])->name('orderHistoryDetail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/addToCart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/checkout', [CheckOutController::class, 'checkOut'])->middleware('auth')->name('checkOut');
Route::post('/checkout', [CheckOutController::class, 'checkOutPost'])->middleware('auth')->name('checkOutPost');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
