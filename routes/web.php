<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/shop/{subcategory?}', [\App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
Route::get('/search', [\App\Http\Controllers\HomeController::class, 'search'])->name('search');


Route::middleware(['roles:admin', 'auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');
    Route::resource('/categories', 'App\Http\Controllers\CategoryController');
    Route::resource('/subcategories', 'App\Http\Controllers\SubcategoryController');
    Route::resource('/toys', 'App\Http\Controllers\ToyController')->except('show');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});
Route::resource('/toys', 'App\Http\Controllers\ToyController')->only('show');
Route::middleware(['auth'])->group(function () {
Route::resource('/carts', 'App\Http\Controllers\CartController')->only('index','store','update','destroy');
Route::get('/orders/myorders', [App\Http\Controllers\OrderController::class, 'myOrders'])->name('orders.myorders');
Route::get('/orders/myorder/{order}', [App\Http\Controllers\OrderController::class, 'myOrder'])->name('orders.myorder');
Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
});
