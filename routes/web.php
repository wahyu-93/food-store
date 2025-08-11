<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// route register
Route::get('/register', Auth\Register::class)->name('register');

// route login
Route::get('/login', Auth\Login::class)->name('login');

// myorder
Route::middleware('auth:customer')->group(function(){
    Route::group(['prefix' => 'account'], function(){
        // my-orders
        Route::get('/my-orders', Account\MyOrders\Index::class)->name('account.my-orders.index');
        Route::get('/my-orders/{snap_token}', Account\MyOrders\Show::class)->name('account.my-orders.show');

        // my-profile
        Route::get('my-profile', Account\MyProfile\Index::class)->name('account.my-profile');

        // my password
        Route::get('/password', Account\Password\Index::class)->name('account.password');
    });
});

// homepage
Route::get('/', Web\Home\Index::class)->name('home');

// products
Route::get('/products', Web\Product\Index::class)->name('web.product.index');
Route::get('/products-populer', Web\Product\ProductPopuler::class)->name('web.product.populer');

// category show
Route::get('/category/{slug}', Web\Category\Show::class)->name('web.category.show');

// product show
Route::get('/products/{slug}', Web\Product\Show::class)->name('web.product.show');

// cart
Route::get('/cart', Web\Cart\Index::class)->name('web.cart.index')->middleware('auth:customer');

// checkput
Route::get('/checkout', Web\Checkout\Index::class)->name('web.checkout.index')->middleware('auth:customer');
