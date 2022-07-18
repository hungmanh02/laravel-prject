<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
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

// route client
Route::get('/',[ HomeController::class,'index'])->name('client.home');
Route::get('/product/{category_id}',[ ClientProductController::class,'index'])->name('client.products.index');
Route::get('/product-detail/{id}',[ ClientProductController::class,'show'])->name('client.products.show');
Route::middleware('auth')->group(function(){
    Route::post('add-to-cart',[CartController::class,'store'])->name('client.carts.add');
    Route::get('carts',[CartController::class,'index'])->name('client.carts.index');
    Route::post('update-quantity-product-in-cart/{id}',[CartController::class,'updateQuantityProduct'])->name('client.carts.update_product_quantity');


});
Auth::routes();
// route admin
Route::middleware('auth')->group(function(){
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::resource('coupons',CouponController::class);
});
