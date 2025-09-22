<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/store', [MainController::class, 'store'])->name('store');
    Route::get('/product/{id}', [MainController::class, 'single'])->name('product.single');
    // Route::get('/about', fn () => view('about'))->name('about');
    // Route::get('/contact', fn () => view('contact'))->name('contact');
});


// Add these to your web.php routes file
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');