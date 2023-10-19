<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\PostProducts;


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


Auth::routes();

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Products 
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);


// Custom Page
Route::view('/custom', 'custom');

// Authentication
Route::post('/logout', [LogoutController::class,'perform'])->name('logout.perform');

// Business Management
Route::get('/business', [BusinessController::class, 'index'])->middleware('auth')->name('business');
Route::get('/business/product/create', [ProductController::class, 'create'])->middleware('auth')->name('product.create');
Route::post('/business/product/create', [ProductController::class, 'store']);
Route::put('/business/product/edit/{id}', [ProductController::class, 'update']);
Route::get('/business/product/gallery', [ImageController::class, 'show']);
Route::get('/business/product/gallery/coverImage', [ImageController::class, 'showCover']);
Route::post('/business/product/upload', [ImageController::class, 'store']);
Route::delete('/business/product/revert', [ImageController::class, 'revert']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::post('/products/{id}/edit/upload', [ImageController::class, 'store']);
Route::delete('/products/{id}/edit/revert', [ImageController::class, 'revert']);
Route::get('images/removeImage', [ProductController::class, 'removeImage'])->middleware('auth')->name("images.removeImage");


