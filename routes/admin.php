<?php
use App\ProductImage;
// DD('TODO: Minus all item out to product stocks');
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\MountManager;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;




Route::middleware('auth:web')->namespace('Admin')->group(function () {


     /*
    |--------------------------------------------------------------------------
    | This code is used to transfer local files to s3 storage
    |--------------------------------------------------------------------------
    */

    // Route::get('s3', function(){
    //     $images = ProductImage::select('img')->pluck('img');

    //     foreach ($images as $image) {

    //         if(file_exists($_SERVER['DOCUMENT_ROOT'].$image)) {
    //             $contents = fopen($_SERVER['DOCUMENT_ROOT'].$image, 'r+');
    //             Storage::disk('s3')->put($image, $contents);
    //         }
    //     }
    // });



    Route::get('dashboard', 'DashboardCon@index');
    
     
    /*
    |--------------------------------------------------------------------------
    | PRODUCTS Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductsCon@index');
        Route::get('/add', 'ProductsCon@add');
        Route::post('/store', 'ProductsCon@store');
        Route::get('/update/{id}', 'ProductsCon@update')->name('products.update');
        Route::post('/patch', 'ProductsCon@patch')->name('products.patch');
        Route::post('/delete', 'ProductsCon@delete')->name('products.delete');
        Route::post('/status', 'ProductsCon@status')->name('products.status');
        Route::post('/restore', 'ProductsCon@restore')->name('products.restore');
        Route::get('/archive', 'ProductsCon@archive');
        
        Route::post('/generate_variant', 'ProductsCon@generate_variant');
    });
    
    /*
    |--------------------------------------------------------------------------
    | ORDERS Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderCon@index');
        Route::get('/view/{transaction_id}', 'OrderCon@show');
        Route::get('/create', 'OrderCon@create');
        Route::post('/store', 'OrderCon@store');
        Route::get('/update/{order_id}', 'OrderCon@update');
        Route::post('/patch', 'OrderCon@patch');
        Route::post('/change-status', 'OrderCon@change_status');
        Route::get('/history', 'OrderCon@history');
    });
    
    /*
    |--------------------------------------------------------------------------
    | SHOPEE Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('shopee')->group(function () {
        Route::get('/', 'ShopeeCon@index');
        Route::get('/orders', 'ShopeeCon@orders');
        Route::get('/create', 'ShopeeCon@create');
        Route::post('/store', 'ShopeeCon@store');
        Route::get('/view/{filename}/{store}', 'ShopeeCon@view')->name('shopee.view');
        Route::get('/view/{filename}/{store}/picklist', 'ShopeeCon@picklist')->name('shopee.view.picklist');
        Route::post('/view/update', 'ShopeeCon@view_update');
        Route::post('/fix-seller-voucher', 'ShopeeCon@fix_seller_voucher');
    });

    /*
    |--------------------------------------------------------------------------
    | INVENTORY Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('inventory')->group(function () {
        Route::get('/', 'InventoryCon@index')->name('inventory.view');
    });

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoriesCon@index')->name('category.list');
        Route::get('/add', 'CategoriesCon@add')->name('category.add');
        Route::post('/store', 'CategoriesCon@store')->name('category.store');
        Route::post('/delete', 'CategoriesCon@delete')->name('category.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | BANNERS Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('banners')->group(function () {
        Route::get('/', 'BannersCon@index')->name('banner.list');
        Route::get('/add', 'BannersCon@add')->name('banner.add');
        Route::post('/store', 'BannersCon@store')->name('banner.store');
    });


        /*
    |--------------------------------------------------------------------------
    | PURCHASE Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('purchase')->group(function () {
        Route::get('/', 'PurchaseCon@index');
        Route::get('/create', 'PurchaseCon@create');
        Route::post('/store', 'PurchaseCon@store');
        Route::get('/view/{id}', 'PurchaseCon@view');
        Route::get('/report', 'PurchaseCon@report');
        Route::post('/report-data', 'PurchaseCon@report_data');
        Route::get('/update/{id}', 'PurchaseCon@update');
        Route::post('/patch', 'PurchaseCon@patch');
    });


     /*
    |--------------------------------------------------------------------------
    | Suppliers Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('suppliers')->group(function () {
        Route::get('/', 'SuppliersCon@index');
        Route::get('/create', 'SuppliersCon@create');
        Route::post('/store', 'SuppliersCon@store')->name('suppliers.store');
        Route::get('/view/{supplier_id}', 'SuppliersCon@view')->name('suppliers.view');
        Route::post('/patch', 'SuppliersCon@patch')->name('suppliers.patch');
    });

    Route::prefix('rts')->group(function () {
        Route::get('/', 'RtsCon@index');
        Route::get('/create', 'RtsCon@create');
        Route::post('/store', 'RtsCon@store');
        Route::post('/view/{transaction_id}', 'RtsCon@view')->name('rts.view');
    });

         /*
    |--------------------------------------------------------------------------
    | Expenses Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('expenses')->group(function () {
        Route::get('/', 'ExpensesCon@index')->name('expenses.index');
        Route::get('/create', 'ExpensesCon@create');
        Route::post('/store', 'ExpensesCon@store')->name('expenses.store');
        Route::get('/view/{supplier_id}', 'ExpensesCon@view')->name('expenses.view');
        Route::get('/update/{id}', 'ExpensesCon@update')->name('expenses.update');
        Route::post('/patch', 'ExpensesCon@patch')->name('expenses.patch');
        
        Route::get('/category', 'ExpensesCon@category')->name('expenses.category');
        Route::post('/category-store', 'ExpensesCon@category_store')->name('expenses.category.store');
        Route::get('/category-delete/{id}', 'ExpensesCon@category_delete')->name('expenses.category.delete');

    });


    Route::prefix('stores')->group(function () {
        Route::get('/', 'StoreCon@index')->name('store.index');
        Route::get('/create', 'StoreCon@create');
        Route::post('/store', 'StoreCon@store')->name('store.store');
        Route::get('/update/{id}', 'StoreCon@update')->name('store.update');
        Route::post('/patch', 'StoreCon@patch')->name('store.patch');
    });


    /*
    |--------------------------------------------------------------------------
    | SHOPEE & LAZADA STORE METRICS Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('store-metrics')->group(function () {
        Route::get('/', 'StoreMetricsCon@index')->name('store.metrics.index');
        Route::get('/create', 'StoreMetricsCon@create');
        Route::post('/store', 'StoreMetricsCon@store')->name('store.metrics.store');
        Route::get('/update/{id}', 'StoreMetricsCon@update')->name('store.metrics.update');
        Route::post('/patch', 'StoreMetricsCon@patch')->name('store.metrics.patch');
    });

    /*
    |--------------------------------------------------------------------------
    | FB ADS ORDERS
    |--------------------------------------------------------------------------
    */
    Route::prefix('fbads')->group(function () {
        Route::get('/', 'FbAdsCon@index')->name('fbads.index');
        Route::get('/event-listener', 'FbAdsCon@event_listener')->name('fbads.event_listener');
        Route::post('/change-status', 'FbAdsCon@change_status');
    });


    Route::prefix('powerup')->group(function () {
        Route::get('/', 'PowerUpCon@index');
        Route::get('/create', 'PowerUpCon@create');
        Route::post('/store', 'PowerUpCon@store')->name('powerup.store');
        Route::get('/update/{id}', 'PowerUpCon@update');
        Route::post('/patch', 'PowerUpCon@patch')->name('powerup.patch');
        Route::post('/mark-as-reviewed', 'PowerUpCon@mark_as_reviewed');
        Route::get('/duplicate', 'PowerUpCon@duplicate');
    });

    Route::prefix('admin-panel')->group(function () {
        Route::get('/', function(){
            return view('admin_panel.index');
        });
    });

});


Route::fallback(function () {
    dd('404 admin');
});