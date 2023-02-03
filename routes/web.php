<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
Auth::routes();


Route::get('download', function(){


    $img = public_path('/images/products/original-0be2aa303e0640c594ba1e5073f2c6cd.jpg');

    $headers = array(
        "Content-Type: image/jpeg"
    );


    return response()->download($img, 'original-0be2aa303e0640c594ba1e5073f2c6cd.jpg', $headers);

    // header("Content-Disposition: attachment; filename=" . $img)
    // $ch = curl_init('http://matildasbeauty.com/images/products/small-09ed1f03ae9e4b899e04b4e24c9c4aa7.jpg');
    // $fp = fopen('/public/test.jpg', 'wb');
    // curl_setopt($ch, CURLOPT_FILE, $fp);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    // curl_exec($ch);
    // curl_close($ch);
    // fclose($fp);
});
