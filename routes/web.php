<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

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

Route::prefix('admin')->group(function(){

    Route::get('/login', function(){
        return view('admin.account.login');
    });

    Route::prefix('/product')->group(function(){

        Route::get('', [ProductController::class, 'index']);
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/create', [ProductController::class, 'store']);
        Route::get('/detail/{product}', [ProductController::class, 'show']);
        Route::get('/edit/{product}', [ProductController::class, 'edit']);
        Route::post('/edit/{product}', [ProductController::class, 'update']);
        Route::post('/delete/{product}', [ProductController::class, 'destroy']);

    });

});

