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
// Route::middleware('auth.customer')->group(function(){
    Route::group(['prefix' => 'account'], function(){
        // my-orders
        Route::get('/my-orders', Account\MyOrders\Index::class)->name('account.my-orders.index');
        Route::get('/my-orders/{snap_token}', Account\MyOrders\Show::class)->name('account.my-orders.show');

        // my-profile
        Route::get('my-profile', Account\MyProfile\Index::class)->name('account.my-profile');

        // my password
        Route::get('/password', Account\Password\Index::class)->name('account.password');
    });
// });

// homepage
Route::get('/', Web\Home\Index::class)->name('home');
