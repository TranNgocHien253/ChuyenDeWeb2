<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\WishlistController;
use App\Http\Controllers\TypeProductController;

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

// Route cho sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::middleware(['auth', 'role:user'])->group(function () {
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('user.profile.edit');
Route::put('/profile/{id}', [UserController::class, 'update'])->name('user.profile.update');
Route::delete('/profile/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});
Route::post('/profile/restore/{id}', [UserController::class, 'restoreUser'])->name('user.restore');

Route::get('/appAdmin', function () {
return view('appAdmin');
})->middleware('auth')->name('appAdmin');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Route xử lý quá trình đăng nhập
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

// Routes for slides
Route::get('/slides', [SlideController::class, 'index'])->name('admin.slides.index');

Route::get('/slides/create', [SlideController::class, 'create'])->name('admin.slides.create');
Route::post('/slides', [SlideController::class, 'store'])->name('admin.slides.store');
Route::get('/slides/{id}/edit', [SlideController::class, 'edit'])->name('admin.slides.edit');
Route::put('/slides/{id}', [SlideController::class, 'update'])->name('admin.slides.update');

Route::delete('/slides/{id}', [SlideController::class, 'destroy'])->name('admin.slides.destroy');

//user
Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/user/{id}', [UserController::class, 'destroyfe'])->name('admin.user.destroyfe');

// Routes for order
Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
Route::get('/order/add', [OrderController::class, 'create'])->name('admin.order.create');
Route::post('/order/add', [OrderController::class, 'store'])->name('admin.order.store');
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
Route::put('/order/{id}', [OrderController::class, 'update'])->name('admin.order.update');
Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');


Route::get('/typeproduct', [TypeProductController::class, 'index'])->name('admin.typeproduct.index');
Route::get('/typeproduct/add', [TypeProductController::class, 'create'])->name('admin.typeproduct.create');
Route::post('/typeproduct/add', [TypeProductController::class, 'store'])->name('admin.typeproduct.store');
Route::get('/typeproduct/{id}/edit', [TypeProductController::class, 'edit'])->name('admin.typeproduct.edit');
Route::put('/typeproduct/{id}', [TypeProductController::class, 'update'])->name('admin.typeproduct.update');
Route::delete('/typeproduct/delete/{id}', [TypeProductController::class, 'destroy'])->name('admin.typeproduct.destroy');


Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index'); // Thay 'manageProduct' bằng 'index'
Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
Route::post('/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');


// Route::post('product/{id}', 'ProductController@update');
// Route::put('product/{id}', 'ProductController@store');

});


Route::get('/user product', [HomeController::class,'userProduct'])->name('admin.product.usersProducts');

// Route cart
Route::get('/cart', [CartController::class, 'getListCart'])->name('cart.list');
Route::get('/products/{id}', [CartController::class, 'show'])->name('product.show');
// In routes/web.php
Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
Route::delete('/cart/delete/{id}/{full_name}/{phone}/{address}', [CartController::class, 'removeProduct'])->name('cart.delete');

Route::post('/cart/delete/{productId}/{full_name}/{phone}/{address}', [CartController::class, 'deleteProductQuantity'])->name('cart.deleteQuantity');

Route::post('/cart/add', [CartController::class, 'addProductToCart'])->middleware('auth');


Route::get('/find product', [HomeController::class,'seachProduct'])->name('product.seach');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/products/type/{id}', [HomeController::class, 'getProductsByType'])->name('products.by.type');

Route::middleware('auth')->group(function () {
Route::post('/wishlist/{productId}/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/{productId}/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.index');
});


// Hiển thị form nhập email
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// Xử lý gửi link reset mật khẩu
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Hiển thị form đặt lại mật khẩu
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

// Xử lý đặt lại mật khẩu
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);