<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;


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
