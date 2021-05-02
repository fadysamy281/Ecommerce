<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\AccountController;
use App\Http\Controllers\Site\HomeController;


Route::get('login',  [LoginController::class , 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class , 'login'])->name('login.post');
Route::get('logout', [LoginController::class , 'logout'])->name('logout');
    

Route::view('/', 'site.pages.homepage');
Route::get('/category/{slug}', [CategoryController::class ,'show'])
    ->name('category.show');
Route::get('/product/{slug}', [ProductController::class , 'show'])->name('product.show');
Route::post('/product/add/cart', [ProductController::class , 'addToCart'])->name('product.add.cart');

Route::get('/cart', [CartController::class , 'getCart'])->name('checkout.cart']);
Route::get('/cart/item/{id}/remove', [CartController::class , 'removeItem'])->name('checkout.cart.remove');
Route::get('/cart/clear', [CartController::class , 'clearCart'])->name('checkout.cart.clear');
Route::middleware(['auth'])->prefix('checkout')->name('checkout.')->group(function(){

    Route::get('/', [CheckoutController::class , 'getCheckout'])->name('index');
    Route::post('/order', [CheckoutController::class , 'placeOrder'])->name('place.order');
    Route::get('/payment/complete',  [CheckoutController::class , 'complete'])->name('payment.complete');

});
Route::get('account/orders', [AccountController::class , 'getOrders'])->name('account.orders');



Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
