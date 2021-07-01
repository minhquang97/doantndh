<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ 'uses' => 'IndexController@getIndex'])->name('index');
Route::get('/about-us', [ 'uses' => 'IndexController@getAbountUs'])->name('about-us');
Route::get('/make-appointment', [ 'uses' => 'IndexController@getMakeAppointment'])->name('make-appointment');
Route::post('/make-appointment/send', [ 'uses' => 'IndexController@postMakeAppointment'])->name('make-appointment-send');
Route::get('/products', [ 'uses' => 'IndexController@getListProduct'])->name('product-list');
Route::get('/products/{id}', [ 'uses' => 'IndexController@getProductDetail'])->name('product-detail');
Route::get('/cart', [ 'uses' => 'IndexController@getCart'])->name('shopping-cart');
Route::post('/add-cart', [ 'uses' => 'IndexController@postAddCart'])->name('post-add-cart');
Route::get('/remove-cart/{id}', [ 'uses' => 'IndexController@removeCart'])->name('remove-cart');

Route::post('/add-coupon', [ 'uses' => 'IndexController@addCoupon'])->name('add-coupon');
Route::get('/remove-coupon/{id?}', [ 'uses' => 'IndexController@removeCoupon'])->name('remove-coupon');
Route::post('/p-checkout-cart', [ 'uses' => 'IndexController@postCheckoutCart'])->name('p-checkout-cart');

Route::get('/checkout-cart/{id?}', [ 'uses' => 'IndexController@checkoutCart'])->name('checkout-cart');
Route::post('/p-checkout/{id?}', [ 'uses' => 'IndexController@postCheckout'])->name('p-checkout');

Route::get('/finish-cart', [ 'uses' => 'IndexController@finishCart'])->name('finish-cart');

Route::get('/customer', [ 'uses' => 'CustomerController@customerInfo'])->name('customer-info');
Route::post('/update-customer', [ 'uses' => 'CustomerController@postCustomerInfo'])->name('update-customer-info');
Route::get('/customer/change-password', [ 'uses' => 'CustomerController@customerChangePassword'])->name('change-customer-password');
Route::post('/customer/change-password/update', [ 'uses' => 'CustomerController@postCustomerChangePassword'])->name('p-change-customer-password');


Route::get('/login','CustomerController@getLogin')->name('login');
Route::post('/p-login','CustomerController@postLogin')->name('post-login');
Route::get('/register','CustomerController@getRegister')->name('get-register');
Route::post('/p-register','CustomerController@register')->name('post-register');
Route::get('/logout','CustomerController@logout')->name('logout');

Route::get('/page-not-found', function(){
    return view('404');
})->name('404');

Route::get('/admin/login','LoginController@getAdminLogin')->name('admin-login');
Route::post('/admin/p-login','LoginController@postAdminLogin')->name('admin-post-login');
Route::get('/admin/logout','LoginController@adminLogout')->name('admin-logout');
Route::group(['prefix'=> 'admin'], function(){
    Route::get('/dashboard','AdminController@getAdminIndex')->name('admin-index');


    Route::group(['prefix' => 'products'], function(){
        Route::get('/', ['uses' => 'ProductController@index'])->name('admin-product-list');
        Route::get('/create', ['uses' => 'ProductController@create'])->name('admin-product-create');
        Route::post('/p-create', ['uses' => 'ProductController@create'])->name('p-admin-product');
        Route::get('/{id}/product', ['uses' => 'ProductController@update'])->name('update-admin-product');
        Route::post('/{id}/product/update', ['uses' => 'ProductController@update'])->name('p-update-admin-product');
        Route::get('/{id}/delete', ['uses' => 'ProductController@delete'])->name('delete-admin-product');
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', ['uses' => 'UserController@index'])->name('admin-user-list');
        Route::get('/create', ['uses' => 'UserController@create'])->name('admin-user-create');
        Route::post('/p-create', ['uses' => 'UserController@create'])->name('p-admin-user');
        Route::get('/{id}/user', ['uses' => 'UserController@update'])->name('update-admin-user');
        Route::post('/{id}/user/update', ['uses' => 'UserController@update'])->name('p-update-admin-user');
        Route::get('/{id}/delete', ['uses' => 'UserController@delete'])->name('delete-admin-user');
        Route::get('/change-password', ['uses' => 'UserController@changePassword'])->name('admin-change-password');
        Route::post('/change-password/update', ['uses' => 'UserController@postChangePassword'])->name('post-admin-change-password');
    });

    Route::group(['prefix' => 'customers'], function(){
        Route::get('/', ['uses' => 'CustomerController@index'])->name('admin-customer-list');
        Route::get('/create', ['uses' => 'CustomerController@create'])->name('admin-customer-create');
        Route::post('/p-create', ['uses' => 'CustomerController@create'])->name('p-admin-customer');
        Route::get('/{id}/customer', ['uses' => 'CustomerController@update'])->name('update-admin-customer');
        Route::post('/{id}/customer/update', ['uses' => 'CustomerController@update'])->name('p-update-admin-customer');
        Route::get('/{id}/delete', ['uses' => 'CustomerController@delete'])->name('delete-admin-customer');
    });

    Route::group(['prefix' => 'coupons'], function(){
        Route::get('/', ['uses' => 'CouponController@index'])->name('admin-coupon-list');
        Route::get('/create', ['uses' => 'CouponController@create'])->name('admin-coupon-create');
        Route::post('/p-create', ['uses' => 'CouponController@create'])->name('p-admin-coupon');
        Route::get('/{id}/coupon', ['uses' => 'CouponController@update'])->name('update-admin-coupon');
        Route::post('/{id}/coupon/update', ['uses' => 'CouponController@update'])->name('p-update-admin-coupon');
        Route::get('/{id}/delete', ['uses' => 'CouponController@delete'])->name('delete-admin-coupon');
    });

    Route::group(['prefix' => 'orders'], function(){
        Route::get('/', ['uses' => 'OrderController@index'])->name('admin-order-list');
        Route::get('/detail/{id}', ['uses' => 'OrderController@detail'])->name('admin-detail-order');
        Route::get('/{id}/order', ['uses' => 'OrderController@update'])->name('update-admin-order');
        Route::post('/{id}/order/update', ['uses' => 'OrderController@update'])->name('p-update-admin-order');
        Route::get('/{id}/delete', ['uses' => 'OrderController@delete'])->name('delete-admin-order');
    });

    Route::get('/make-appointment', ['uses' => 'AdminController@makeAppointment'])->name('admin-make-appointment');
    Route::post('/make-appointment/closed', ['uses' => 'AdminController@closedMakeAppointment'])->name('admin-make-appointment-closed');
    Route::get('/make-appointment/{id}/detail', ['uses' => 'AdminController@detailMakeAppointment'])->name('admin-make-appointment-detail');
});
