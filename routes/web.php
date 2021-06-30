<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/',function (){
    return redirect()->route('product.index');
});

Route::middleware(['locale'])->prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
});


Route::prefix('admin')->group(function () {
    Route::get('/',[AdminController::class,'index'])->name('admin.index');
});

Route::prefix('product')->group(function (){
    Route::get('/',[ProductController::class,'index'])->name('product.index');
    Route::get('/shop-page', [ProductController::class, 'list_shop'])->name('product.shop');
});

Route::prefix('user')->group(function (){
    Route::get('/login',[UserController::class,'showFormLogin'])->name('user.showFormLogin');
    Route::post('/login',[UserController::class,'login'])->name('user.login');
    Route::get('/register',[UserController::class,'showFormRegister'])->name('user.showFormRegister');
    Route::post('/store',[UserController::class,'store'])->name('user.store');
    Route::get('/logout',[UserController::class,'logout'])->name('user.logout');
});


