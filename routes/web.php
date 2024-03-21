<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductVariansController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CartController;

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
   return view('welcome');
});

Route::get('/home', [App\Http\Controllers\client\HomeController::class, 'home'])->name('homePage');
Route::get('/blog', function () {
   return view('client.blog');
});
Route::match(['POST', 'GET'], '/shop', [HomeController::class, 'shop']);
Route::get('/detail_product', [HomeController::class, 'ProductDetail'])->name('detail_product');


Route::get('/contact', function () {
   return view('client.contact');
});
Route::get('/detail_blog', function () {
   return view('client.detail_blog');
});

Route::get('/signup', function () {
   return view('auth.signup');
});
Route::get('/signin', function () {
   return view('auth.signin');
});
//account admin
route::get('loginAdmin', [AdminController::class, 'login']);
route::post('loginAdmin', [AdminController::class, 'postlogin'])->name('admin.login');
route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

route::middleware(['admin'])->group(function () {
   route::prefix('admin')->group(function () {
      Route::get('/', function () {
         return view('admin.dashboard');
      })->name('admin.index');
      //products route
      route::resource('product', ProductsController::class);
      //products variant route
      route::resource('productVariant', ProductVariansController::class);
      //category route 
      route::resource('category', CategoryController::class);
      //size
      route::resource('size', SizeController::class);
      //color
      route::resource('color', ColorController::class);
      //user route
      route::get('listUser', [UserController::class, 'index'])->name('listUser');
      route::get('listAdmin', [UserController::class, 'admin'])->name('listAdmin');
      //order route
      Route::get('/order', [OrderController::class,'index'])->name('orderAdmin');
      //voucher route
      Route::resource('voucher', VoucherController::class);
   });
});


//account user
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/signup', [SignUpController::class, 'showRegistrationForm'])->name('signup');
// Route xử lý đăng ký
Route::post('/signup', [SignUpController::class, 'signup']);
//delete acc
Route::get('/delete-account', [AccountController::class, 'showDeleteForm'])->name('account.delete');
Route::delete('/delete-account', [AccountController::class, 'delete'])->name('account.destroy');



Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

//checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');
