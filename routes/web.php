<?php

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

Route::get('/','App\Http\Controllers\frontend\HomeController@index')->name('homeFrontend.index');


Route::get('/categories/{categoryId}','App\Http\Controllers\frontend\CategoriesController@sortFollowCategoryName')
->name('categoryFrontend.sortFollowCategoryName');

Route::get('/search/{productName?}','App\Http\Controllers\frontend\CategoriesController@searchProduct')
->name('categoryFrontend.searchProduct');

Route::get('/addToWishList/{customer_id}/{product_id}','App\Http\Controllers\frontend\WishListController@addToWishList')->name('WishListController.addToWishList');

Route::get('/product/smartSearch/{key}','App\Http\Controllers\frontend\ProductController@smartSearch')->name('productFrontend.smartSearch');
Route::get('/product-detail/{id}','App\Http\Controllers\frontend\ProductController@index')->name('productFrontend.index');
Route::post('/product-detail/{id}/review','App\Http\Controllers\frontend\ProductController@review')->name('productFrontend.review');

Route::get('/cart','App\Http\Controllers\frontend\CartController@index')->name('cart.index');
Route::get('/quickcart/{id}','App\Http\Controllers\frontend\CartController@quickAddToCart')->name('cart.quickAddToCart');
Route::post('/cart','App\Http\Controllers\frontend\CartController@addToCart')->name('cart.addToCart');
Route::get('/cart/clear','App\Http\Controllers\frontend\CartController@clearCart')->name('cart.clearCart');
Route::get('/cart/clearItem/{id}','App\Http\Controllers\frontend\CartController@clearItem')->name('cart.clearItem');
Route::post('/cart/update','App\Http\Controllers\frontend\CartController@update')->name('cart.update');
Route::post('/cart/checkout','App\Http\Controllers\frontend\CartController@checkoutCart')->name('cart.checkout');
Route::post('/cart/checkoutByCard','App\Http\Controllers\frontend\CartController@checkoutByCard')->name('cart.checkoutByCard');
// Route::get('/checkout','App\Http\Controllers\frontend\CheckoutController@index')->name('checkout.index');
// Route::post('/checkout','App\Http\Controllers\frontend\CheckoutController@postPaymentStripe')->name('checkout.postPaymentStripe');

//login customer
Route::get('/login','App\Http\Controllers\frontend\LoginController@login')->name('frontend.login');
Route::post('/login','App\Http\Controllers\frontend\LoginController@loginPost')->name('frontend.loginPost');
Route::get('/register','App\Http\Controllers\frontend\LoginController@register')->name('frontend.register');
Route::post('/register','App\Http\Controllers\frontend\LoginController@registerPost')->name('frontend.registerPost');
Route::get('/account/verify/{token}', 'App\Http\Controllers\frontend\LoginController@verifyRegisterAccount')->name('user.verify');
Route::get('/forgotPassword','App\Http\Controllers\frontend\LoginController@forgotPassword')->name('LoginController.forgotPassword');
Route::post('/forgotPassword','App\Http\Controllers\frontend\LoginController@forgotPasswordPost')->name('LoginController.forgotPasswordPost');
Route::get('/passwordReset/verify/{token}', 'App\Http\Controllers\frontend\LoginController@verifyResetPassword')->name('password.verify');
Route::get('/logout','App\Http\Controllers\frontend\LoginController@logout')->name('frontend.logout');
Route::get('auth/facebook', 'App\Http\Controllers\frontend\FacebookController@redirectToFacebook')->name('FacebookController.redirectToFacebook');
Route::get('auth/facebook/callback', 'App\Http\Controllers\frontend\FacebookController@facebookSignIn')->name('FacebookController.facebookSignIn');



//login admin
Route::prefix('admin')->group(function () {
    Route::get('/login','App\Http\Controllers\backend\LoginController@login')->name('LoginController.login');
    Route::post('/login','App\Http\Controllers\backend\LoginController@loginPost')->name('LoginController.loginPost');
    Route::get('/register','App\Http\Controllers\backend\LoginController@register')->name('LoginController.register');
    Route::post('/register','App\Http\Controllers\backend\LoginController@registerPost')->name('LoginController.registerPost');
    Route::get('/logout','App\Http\Controllers\backend\LoginController@logout')->name('LoginController.logout');
    Route::get('/forgotPassword','App\Http\Controllers\backend\LoginController@forgotPassword')->name('admin.forgotPassword');
    Route::post('/forgotPassword','App\Http\Controllers\backend\LoginController@forgotPasswordPost')->name('admin.forgotPasswordPost');
});



//admin
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/','App\Http\Controllers\backend\HomeController@index')->name('HomeController.index');
    Route::get('/inventory', 'App\Http\Controllers\backend\ProductController@inventory')->name('products.inventory');
    Route::resource('categories', 'App\Http\Controllers\backend\CategoryController')->except(['show']);
    Route::resource('products', 'App\Http\Controllers\backend\ProductController');
    Route::resource('reviews', 'App\Http\Controllers\backend\ReviewController')->only(['show', 'index']);
    Route::resource('contacts', 'App\Http\Controllers\backend\ContactController')->except('destroy');
    Route::post('products/search', 'App\Http\Controllers\backend\ProductController@search')->name('products.search');
    Route::resource('users', 'App\Http\Controllers\backend\UserController')->middleware(['can:show user']);
    Route::post('users/search', 'App\Http\Controllers\backend\UserController@search')->name('users.search');
    Route::resource('customers', 'App\Http\Controllers\backend\CustomerController')->middleware(['can:show customer'])->only(['index', 'show', 'destroy']);
    Route::post('customers/search', 'App\Http\Controllers\backend\CustomerController@search')->name('customers.search');
    Route::get('orders/delivery/{id}', 'App\Http\Controllers\backend\OrderController@delivery')->name('orders.delivery');
    Route::get('orders/payment/{id}', 'App\Http\Controllers\backend\OrderController@payment')->name('orders.payment');
    Route::resource('orders', 'App\Http\Controllers\backend\OrderController')->only(['index', 'show']);
    Route::get('/status/sell','App\Http\Controllers\backend\StatusController@sell')->name('StatusController.sell');
    Route::get('/status/refund','App\Http\Controllers\backend\StatusController@refund')->name('StatusController.refund');
    Route::get('/status/sellToRefund/{id}','App\Http\Controllers\backend\StatusController@sellToRefund')->name('StatusController.sellToRefund');
    Route::get('thong_ke', 'App\Http\Controllers\backend\ThongKeController@index')->middleware(['can:show statistical'])->name("ThongKeController.index");
    Route::post('thong_ke', 'App\Http\Controllers\backend\ThongKeController@search');
    Route::resource('warranty', 'App\Http\Controllers\backend\WarrantyController')->only(['index', 'edit', 'update', 'destroy']);
});

//slug
// Route::get('/{slug?}','App\Http\Controllers\frontend\HomeController@index')->name('homeFrontend.index');
Route::fallback('App\Http\Controllers\frontend\HomeController@index');
