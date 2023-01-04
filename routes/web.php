<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

/* ---------------------------------- Admin Route ---------------------------------- */

Route::prefix('admin')->group(function (){

    Route::get('/login',[AdminController::class, 'login_form'])->name('admin.login_form');

    Route::post('/login/store',[AdminController::class, 'login_store'])->name('admin.login_store');

    Route::get('/dashboard',[AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');

    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');

    Route::get('/product-edit/{id}', [AdminController::class, 'edit_product'])->name('product-edit')->middleware('admin');

    Route::post('/update_barang', [AdminController::class, 'update_barang'])->name('admin.update-barang')->middleware('admin');

    Route::get('/incoming-order', [AdminController::class, 'incoming_order'])->name('incoming-order')->middleware('admin');

    Route::get('/order-detail/{id}', [AdminController::class,'order_detail'])->name('order-detail')->middleware('admin');
    
    Route::get('/add-product', function(){
        return view('admin.add-product');
    })->name('add-product')->middleware('admin');
    
    Route::get('/confirm-order/{id}', [AdminController::class,'confirm_order'])->middleware('admin');

    Route::get('/shipping/{id}', [AdminController::class,'shipping_order'])->middleware('admin');

});

/* ---------------------------------- End Admin Route ---------------------------------- */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('profile', [App\Http\Controllers\ProfileController::class,'index'])->middleware(['auth', 'verified'])->name('profile.index');
Route::post('profile', [App\Http\Controllers\ProfileController::class,'update'])->middleware(['auth', 'verified'])->name('profile.edit');

Route::get('dashboard', [App\Http\Controllers\UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('pesan/{id}', [App\Http\Controllers\PesanController::class,'index']);
Route::post('pesan/{id}', [App\Http\Controllers\PesanController::class,'pesan']);
Route::get('check-out', [App\Http\Controllers\PesanController::class,'check_out']);
Route::delete('check-out/{id}', [App\Http\Controllers\PesanController::class,'delete']);

Route::get('konfirmasi-check-out', [App\Http\Controllers\PesanController::class,'konfirmasi']);
Route::get('history', [App\Http\Controllers\HistoryController::class,'index'])->middleware(['auth', 'verified'])->name('history');
Route::get('history/{id}', [App\Http\Controllers\HistoryController::class,'detail'])->middleware(['auth', 'verified'])->name('detail');
Route::get('history/selesai/{id}', [App\Http\Controllers\HistoryController::class,'selesai'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';