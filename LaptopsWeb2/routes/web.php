<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
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
    Route::post('/slides', [SlideController::class, 'store'])->name('admin.slides.store');
    Route::get('/slides', [SlideController::class, 'index'])->name('admin.slides.index');

    Route::get('/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');

    Route::get('/slides/{id}/edit', [SlideController::class, 'edit'])->name('admin.slides.edit');
    Route::put('/slides/{id}', [SlideController::class, 'update'])->name('admin.slides.update');

    Route::delete('/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');
});

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


//user

Route::get('/user', [UserController::class, 'index'])->name('admin.user.index'); // Hiển thị danh sách người dùng
Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create'); // Form tạo người dùng
Route::post('/user', [UserController::class, 'store'])->name('admin.user.store'); // Xử lý tạo người dùng
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit'); // Form sửa người dùng
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update'); // Xử lý sửa người dùng
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
