<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductAttributeController;

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

Route::view('/','admin.dashboard.index')->name('dashboard');
    


Route::get('/settings', [ SettingController::class , 'index'])->name('settings');
Route::post('/settings', [ SettingController::class , 'update'])->name('settings.update');
Route::group(['prefix' => 'orders'], function () {
   Route::get('/',  [ OrderController::class , 'index'])->name('orders.index');
   Route::get('/{order}/show',  [ OrderController::class , 'show'])->name('orders.show');
});
/*
Route::view('/admin', 'admin.dashboard.index');
Route::view('/admin/login', 'admin.auth.login');
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::prefix( 'categories')->name('categories.')->group(function(){

    Route::get('/', [CategoryController::class , 'index'])->name('index');
    Route::get('/create', [CategoryController::class , 'create'])->name('create');
    Route::post('/store', [CategoryController::class , 'store'])->name('store');
    Route::get('/{id}/edit', [CategoryController::class , 'edit'])->name('edit');
    Route::post('/update', [CategoryController::class , 'update'])->name('update');
    Route::get('/{id}/delete', [CategoryController::class , 'delete'])->name('delete');

});
Route::prefix( 'attributes')->name('attributes.')->group(function(){

    Route::get('/', [AttributeController::class , 'index'])->name('index');
    Route::get('/create', [AttributeController::class , 'create'])->name('create');
    Route::post('/store', [AttributeController::class , 'store'])->name('store');
    Route::get('/{id}/edit', [AttributeController::class , 'edit'])->name('edit');
    Route::post('/update', [AttributeController::class , 'update'])->name('update');
    Route::get('/{id}/delete', [AttributeController::class , 'delete'])->name('delete');

});
Route::post('/get-values', [AttributeValueController::class , 'getValues']);
Route::post('/add-values', [AttributeValueController::class , 'addValues']);
Route::post('/update-values', [AttributeValueController::class , 'updateValues']);
Route::post('/delete-values', [AttributeValueController::class , 'deleteValues']);

Route::prefix( 'brands')->name('brands.')->group(function(){

    Route::get('/', [BrandController::class , 'index'])->name('index');
    Route::get('/create', [BrandController::class , 'create'])->name('create');
    Route::post('/store', [BrandController::class , 'store'])->name('store');
    Route::get('/{id}/edit', [BrandController::class , 'edit'])->name('edit');
    Route::post('/update', [BrandController::class , 'update'])->name('update');
    Route::get('/{id}/delete', [BrandController::class , 'delete'])->name('delete');

});

Route::prefix( 'products')->name('products.')->group(function(){

    Route::get('/', [ProductController::class , 'index'])->name('index');
    Route::get('/create', [ProductController::class , 'create'])->name('create');
    Route::post('/store', [ProductController::class , 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class , 'edit'])->name('edit');
    Route::post('/update', [ProductController::class , 'update'])->name('update');
    Route::post('images/upload',  [ProductImageController::class , 'upload'])->name('images.upload');
    Route::get('images/{id}/delete',  [ProductImageController::class , 'delete'])->name('images.delete');
    // Load attributes on the page load
    Route::get('attributes/load',  [ProductAttributeController::class , 'loadAttributes'])->name('loadAttributes');
    // Load product attributes on the page load
    Route::post('attributes',  [ProductAttributeController::class , 'productAttributes'])->name('productAttributes');
    // Load option values for a attribute
    Route::post('attributes/values',  [ProductAttributeController::class , 'loadValues'])->name('loadValues');
    // Add product attribute to the current product
    Route::post('attributes/add',  [ProductAttributeController::class , 'addAttribute'])->name('addAttribute');
    // Delete product attribute from the current product
    Route::post('attributes/delete',  [ProductAttributeController::class , 'deleteAttribute'])->name('deleteAttribute');
});
