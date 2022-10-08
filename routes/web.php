<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

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
Route::get('/', function () {
    return redirect()->route('store');
});
Auth::routes();
Route::get('/home',                 [HomeController::class, 'index'])->name('home');
Route::get('/store',                [HomeController::class, 'store'])->name('store');
Route::get('/products',             [ProductController::class, 'index'])->name('product.index');
Route::delete('/products/{product}',[ProductController::class, 'destroy'])->name('product.remove');
Route::put('/products/{product}',   [ProductController::class, 'update'])->name('product.update');
Route::get('/addToCart/{product}',  [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/shopping-cart',        [ProductController::class, 'showCart'])->name('cart.show');
Route::get('/checkout/{amount}',    [ProductController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::post('/charge',              [ProductController::class, 'charge'])->name('cart.charge');
Route::get('/orders',               [OrderController::class, 'index'])->name('order.index');
// Route::get('send-email',            [ContactController::class, 'index']);
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
