<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VariationController;
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

Route::group([
    'middleware' => ['locale', 'district', 'additional']
], function () {
    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'front.',
    ], function () {
        Route::get('/', 'StoreController@home')->name('home');
        Route::get('/shop', 'StoreController@shop')->name('shop');
        Route::get('/product/{slug?}', 'StoreController@single')->name('single');
        Route::get('/set-district/{district?}', 'StoreController@selectDistrict')->name('set_district');
        Route::get('/cart', 'StoreController@cart')->name('cart');
        Route::get('/checkout', 'StoreController@checkout')->name('checkout')->middleware(['auth', 'verified']);
        Route::get('/profile', 'ProfileController@profile')->name('profile')->middleware(['auth', 'verified']);
        Route::post('/profile', 'ProfileController@update')->name('update_profile')->middleware(['auth', 'verified']);
        Route::post('/pass-update', 'ProfileController@update_pass')->name('update_pass')->middleware(['auth', 'verified']);
    });

    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'cart.',

    ], function () {
        Route::post('update', 'CartController@updateCart')->name('update');
        Route::post('delete', 'CartController@deleteItemFromCart')->name('delete');
    });

    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'order.',

    ], function () {
        Route::get('invoice/{order?}', 'OrderController@invoice')->name('invoice');
        Route::post('store', 'OrderController@store')->name('store');
    });
});

Route::group([
    'namespace' => 'App\Http\Controllers\Backend',
    'as'        => 'admin.',
    'prefix'    => 'admin'
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::group([], function () {
        Route::resource('products', ProductController::class);
        Route::resource('variations', VariationController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::group([
            'as'        => 'delivery.',
            'prefix'    => 'delivery'
        ], function () {
            Route::get('', 'DeliveryController@index')->name('index');
            Route::post('', 'DeliveryController@store')->name('store');
            Route::put('update', 'DeliveryController@update')->name('update');
            Route::delete('delete', 'DeliveryController@destroy')->name('destory');
        });
    });
});

Auth::routes(['verify' => true]);
