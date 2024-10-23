<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;



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

Route::get('/', function () {
    return view('app');
});




// Routes for slides
Route::get('/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');
Route::post('/slides', [SlideController::class, 'store'])->name('admin.slides.store');

Route::get('/slides', [SlideController::class, 'index'])->name('admin.slides.index');

Route::get('/slides/{id}/edit', [SlideController::class, 'edit'])->name('admin.slides.edit');
Route::put('/slides/{id}', [SlideController::class, 'update'])->name('admin.slides.update');

Route::delete('/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');

Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
Route::get('/order/add', [OrderController::class, 'create'])->name('admin.order.create');
Route::post('/order/add', [OrderController::class, 'store'])->name('admin.order.store');
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
Route::put('/order/{id}', [OrderController::class, 'update'])->name('admin.order.update');
Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
