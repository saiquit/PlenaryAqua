<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VariationController;
use App\Http\Controllers\Frontend\BkashPaymentController;
use App\Http\Controllers\Frontend\BkashTokenizePaymentController;
use App\Http\Controllers\Frontend\NagadController;
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

// Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\ChatController@handle');
Route::group([
    'middleware' => ['locale', 'district', 'additional']
], function () {
    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'front.',
    ], function () {
        // Route::get('/', function () {
        //     return view('maintainence');
        // })->name('home');
        Route::get('/', 'StoreController@home')->name('home');

        Route::get('/shop', 'StoreController@shop')->name('shop');
        Route::get('/blogs', 'StoreController@blogs')->name('blogs');
        Route::get('/blogs/{slug?}', 'StoreController@single_blog')->name('single_blog');
        Route::get('/product/{slug?}', 'StoreController@single')->name('single');
        Route::get('/set-district/{district?}', 'StoreController@selectDistrict')->name('set_district');
        Route::get('/cart', 'StoreController@cart')->name('cart');
        Route::get('/contact', 'StoreController@contact')->name('contact');
        Route::post('/contact', 'StoreController@do_contact')->name('do_contact');
        Route::get('/checkout', 'StoreController@checkout')->name('checkout')->middleware(['auth', 'verified']);
        Route::get('/profile', 'ProfileController@profile')->name('profile')->middleware(['auth', 'verified', 'role:customer']);
        Route::post('/profile', 'ProfileController@update')->name('update_profile')->middleware(['auth', 'verified', 'role:customer']);
        Route::post('/address', 'ProfileController@store_address')->name('store_address')->middleware(['auth', 'verified', 'role:customer']);
        Route::post('/address_update', 'ProfileController@update_current_address')->name('address_update')->middleware(['auth', 'verified', 'role:customer']);
        Route::delete('/address_delete/{address}', 'ProfileController@delete_address')->name('address_delete')->middleware(['auth', 'verified', 'role:customer']);
        // Route::post('/pass-update', 'ProfileController@update_pass')->name('update_pass')->middleware(['auth', 'verified', 'role:customer']);
        Route::post('/store-sub', 'StoreController@store_subscriber')->name('store-sub');
        Route::get('/wishes', 'StoreController@love')->name('love')->middleware(['auth', 'verified', 'role:customer']);
        //comment
        Route::post('/comment', 'CommentController@store')->name('store_comment');
        //projects
        Route::get('/projects', 'StoreController@projects')->name('projects');
        //additional pages
        Route::get('/about', 'StoreController@about')->name('about');
        Route::get('/policy', 'StoreController@privacy')->name('policy');
        Route::get('/terms', 'StoreController@terms')->name('terms');
        Route::get('/faq', 'StoreController@faq')->name('faq');
        Route::get('/orders', 'StoreController@orders')->name('orders')->middleware('auth');
        //love product
        Route::post('/love_store/{product}', 'LoveController@storeLove')->name('store_love')->middleware(['auth', 'verified', 'role:customer']);
    });


    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'cart.',

    ], function () {
        Route::post('update', 'CartController@updateCart')->name('update');
        Route::post('delete', 'CartController@deleteItemFromCart')->name('delete');
        Route::post('discount', 'CartController@discount')->name('discount');
        Route::post('redeem', 'CartController@redeem')->name('redeem');
    });

    Route::group([
        'namespace' => 'App\Http\Controllers\Frontend',
        'as'        => 'order.',

    ], function () {
        Route::get('invoice/{order?}', 'OrderController@invoice')->name('invoice');
        Route::post('store', 'OrderController@store')->name('store');
        Route::post('cancle/{order?}', 'OrderController@cancleOrder')->name('cancle');
    });

    Route::get('mail', function () {
        return view('mail.account.confirm');
    });
});

Route::group([
    'namespace' => 'App\Http\Controllers\Backend',
    'as'        => 'admin.',
    'prefix'    => 'admin',
    'middleware' => ['role:admin']
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::group([], function () {
        Route::resource('products', ProductController::class);
        Route::resource('variations', VariationController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('tags', TagController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('faqs', FAQController::class);
        Route::resource('users', UserController::class);

        //Pages Data
        Route::group([
            'as'        => 'page.',
            'prefix'    => 'page'
        ], function () {
            Route::get('', 'PageController@index')->name('index');
            Route::post('', 'PageController@store')->name('store');
        });

        //Delivery Cost
        Route::group([
            'as'        => 'delivery.',
            'prefix'    => 'delivery'
        ], function () {
            Route::get('', 'DeliveryController@index')->name('index');
            Route::post('', 'DeliveryController@store')->name('store');
            Route::put('update', 'DeliveryController@update')->name('update');
            Route::delete('delete', 'DeliveryController@destroy')->name('destory');
        });

        //Coupons
        Route::group([
            'as'        => 'coupons.',
            'prefix'    => 'coupons'
        ], function () {
            Route::get('', 'CouponController@index')->name('index');
            Route::post('', 'CouponController@store')->name('store');
            Route::put('update', 'CouponController@update')->name('update');
            Route::delete('delete', 'CouponController@destroy')->name('destory');
        });
        //Slides
        Route::group([
            'as'        => 'ui.',
            'prefix'    => 'ui'
        ], function () {
            Route::get('newsletters', 'UiController@newsletters')->name('newsletter');
            Route::post('newsletters', 'UiController@store_news')->name('newsletter_store');
            Route::get('slides', 'UiController@slides')->name('slides');
            Route::post('slides', 'UiController@storeSlide')->name('slides_store');
            Route::put('slides/{id}', 'UiController@update_slide')->name('slides_update');
            Route::delete('slides/{id}', 'UiController@delete')->name('slide_delete');
            Route::get('offers', 'UiController@offers')->name('offers');
            Route::post('offers', 'UiController@store_offers')->name('store_offers');
            Route::put('offers/{id}', 'UiController@update_offer')->name('offers_update');
            Route::delete('offers/{id}', 'UiController@delete_offer')->name('offers_delete');
        });
    });
    Route::get('/read_notification', 'DashboardController@read_notification')->name('read');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Backend',
    'as'        => 'admin.auth.',
    'prefix'    => 'admin',
], function () {
    Route::get('login', 'AuthController@login')->name('login')->middleware('guest');
    Route::post('login', 'AuthController@do_login')->name('do_login')->middleware('throttle:10,2');
});


Auth::routes(['verify' => true]);



//payment

// Route::get('/bkash/payment', [BkashTokenizePaymentController::class, 'index'])->name('bkash.pay');
Route::get('/bkash/create-payment', [BkashTokenizePaymentController::class, 'createPayment'])->name('bkash-create-payment');
Route::get('/bkash/callback', [BkashTokenizePaymentController::class, 'callBack'])->name('bkash-callBack');

//search payment
Route::get('/bkash/search/{trxID}', [BkashTokenizePaymentController::class, 'searchTnx'])->name('bkash-serach');

//refund payment routes
Route::get('/bkash/refund', [BkashTokenizePaymentController::class, 'refund'])->name('bkash-refund');
Route::get('/bkash/refund/status', [BkashTokenizePaymentController::class, 'refundStatus'])->name('bkash-refund-status');

Route::get('/nagad/pay', [NagadController::class, 'pay'])->name('nagad.pay');
Route::get('/nagad/callback', [NagadController::class, 'callback']);
Route::get('/nagad/refund/{paymentRefId}', [NagadController::class, 'refund']);
