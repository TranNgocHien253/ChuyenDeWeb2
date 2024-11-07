<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
//này của home
Route::get('/', function () {
    return view('app');
});
// Route::get('/', function () {
//     return view('user.home_list.home');
// });


// Route cho sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('user.home');

// Route::middleware(['auth', 'role:user'])->group(function () {});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route xử lý quá trình đăng nhập
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Routes for slides
    Route::get('/slides', [SlideController::class, 'index'])->name('admin.slides.index');

    Route::get('/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');

    Route::get('/slides/{id}/edit', [SlideController::class, 'edit'])->name('admin.slides.edit');
    Route::put('/slides/{id}', [SlideController::class, 'update'])->name('admin.slides.update');

    Route::delete('/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');

});
Route::post('/slides', [SlideController::class, 'store'])->name('admin.slides.store');

// Public route example
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
// Routes for order
Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
Route::get('/order/add', [OrderController::class, 'create'])->name('admin.order.create');
Route::post('/order/add', [OrderController::class, 'store'])->name('admin.order.store');
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
Route::put('/order/{id}', [OrderController::class, 'update'])->name('admin.order.update');
Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');

// product
// Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
// Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');


// Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');

// Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
// //them san pham
// Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
// Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');

// Route::get('/product', [ProductController::class, 'index'])->name('admin.product.manageProduct');


Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index'); // Thay 'manageProduct' bằng 'index'
Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');


Route::get('/typeproduct', [TypeProductController::class, 'index'])->name('admin.typeproduct.index');
Route::get('/typeproduct/add', [TypeProductController::class, 'create'])->name('admin.typeproduct.create');
Route::post('/typeproduct/add', [TypeProductController::class, 'store'])->name('admin.typeproduct.store');
Route::get('/typeproduct/{id}/edit', [TypeProductController::class, 'edit'])->name('admin.typeproduct.edit');
Route::put('/typeproduct/{id}', [TypeProductController::class, 'update'])->name('admin.typeproduct.update');
Route::delete('/typeproduct/delete/{id}', [TypeProductController::class, 'destroy'])->name('admin.typeproduct.destroy');


Route::get('/user', [UserController::class, 'index'])->name('admin.user.index'); 
Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create'); 
Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit'); 
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

