<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;


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
   
});

//Frontend Route

Route::get('', function(){
    return view('frontend.index');
});

Route::get('/shop', [ShopController::class, 'index']);
Route::get('/product/{product}', [ShopController::class, 'product']);
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('addToCart');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
