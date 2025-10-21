<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// phpinfo();
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

// AUTH
Auth::routes(['login' => false]);
Route::get('/auth/facebook', 'Auth\SocialiteCon@facebook_redirect')->name('auth.fb');
Route::get('/auth/facebook/callback', 'Auth\SocialiteCon@facebook_callback');

//Home
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', "HomeController@index");

Route::get('/contact-us', "HomeController@contactus")->name('contactus');

Route::get('/about-us', "HomeController@aboutus")->name('aboutus');

Route::get('/policy', "HomeController@policy")->name('policy');

Route::get('/terms', "HomeController@terms")->name('terms');

Route::group(['middleware' => ['auth']], function () {
    // User dashboard
    Route::get('dashboard', 'UserCon@dashboard')->name('dashboard');
    Route::get('dashboard/order/{transaction_id}', 'UserCon@order_view')->name('dashboard.order.view');
    Route::post('dashboard/profile/update', 'UserCon@profile_update')->name('dashboard.profile.update');

});// authenticated User's only

//Products
Route::get('{slug}-i.{item_id}', 'ProductsCon@show')->where(['item_id' => '[0-9]+', 'slug' => '.*']);
Route::get('products', 'ProductsCon@all')->name('products.all');
Route::get('auto-complete', 'ProductsCon@auto_complete')->name('products.auto_complete');

// CART
Route::get('cart', 'CartCon@index')->name('cart');
Route::get('cart/add/{id}', 'CartCon@add')->name('cart.add');
Route::get('cart/clear/all', 'CartCon@clear_all')->name('cart.clear.all');
Route::get('cart/count', 'CartCon@count')->name('cart.count');

// WISHLIST
Route::get('wishlist/add/{product_id}', 'WishListCon@create');

// CHECKOUT
Route::get('checkout/{base64_item_details}', 'CheckoutCon@index')->name('checkout');

// PAYMENT 
Route::get('payment', 'PaymentController@index');
Route::post('charge', 'PaymentController@charge')->name('charge');
Route::get('payment-success', 'PaymentController@payment_success');// for cash on delivery
Route::get('payment-success-paypal', 'PaymentController@payment_success_paypal');// for paypal not used
Route::get('payment-error', 'PaymentController@payment_error');

// MissTisa
Route::get('MissTisa', 'MissTisaCon@index')->name('miss_tisa');
Route::get('MissTisa-Promo', 'MissTisaCon@misstisa_promo')->name('misstisa_promo');
Route::post('MissTisa-Submit', 'MissTisaCon@store')->name('miss_tisa_submit');
Route::get('MissTisa-Success', 'MissTisaCon@success')->name('miss_tisa_success');

// FB Ads Pages
Route::get('smart-home-ph', 'FbAdsCon@smart_home_ph')->name('smart_home_ph');
Route::get('ginger-oil', 'FbAdsCon@ginger_oil')->name('ginger_oil');
Route::get('MissTisaMelasma', 'FbAdsCon@misstisa_melasma')->name('misstisa_melasma');
Route::get('MissTisaSerum', 'FbAdsCon@misstisa_serum')->name('misstisa_serum');// Old Pixel - Delete Once "MissTisaSerumNew" is ready
Route::get('MissTisaSerumNew', 'FbAdsCon@misstisa_serum_new')->name('misstisa_serum_new');// New Pixel


Route::get('MissTisa-Gentle-Exfoliating-Toner', 'FbAdsCon@misstisa_toner')->name('misstisa_toner');// New Pixel
Route::get('MissTisa-Advanced-Brightening-Night-Cream', 'FbAdsCon@nightcream')->name('nightcream');// New Pixel


Route::post('Madella-Submit', 'FbAdsCon@store')->name('madella_submit');
Route::post('Madella-Order-Success-Email', 'FbAdsCon@madella_order_success_email')->name('madella_order_success_email');

// FOR DROP-DOWN ADDRESS
Route::post('get-cities', 'FbAdsCon@cities');
Route::post('get-barangay', 'FbAdsCon@barangay');

// FB ADS EVENT LISTENER
Route::post('event-listener', 'FbAdsCon@event_listener')->name('event.listener');

Auth::routes();

// http://127.0.0.1:8000/
// php artisan serve --host 0.0.0.0 --port 80
