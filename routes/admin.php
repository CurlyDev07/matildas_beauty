<?php
use App\ProductImage;
// DD('TODO: Minus all item out to product stocks');
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\MountManager;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;




Route::middleware('auth:web')->namespace('Admin')->group(function () {


    // Order Sources CRUD
    Route::group(['prefix' => 'order-sources', 'middleware' => 'auth'], function() {
        Route::get('/', 'OrderSourceController@index')->name('order-sources.index');
        Route::get('/create', 'OrderSourceController@create')->name('order-sources.create');
        Route::post('/', 'OrderSourceController@store')->name('order-sources.store');
        Route::get('/{id}/edit', 'OrderSourceController@edit')->name('order-sources.edit');
        Route::put('/{id}', 'OrderSourceController@update')->name('order-sources.update');
        Route::delete('/{id}', 'OrderSourceController@destroy')->name('order-sources.destroy');
        Route::post('/{id}/toggle', 'OrderSourceController@toggleActive')->name('order-sources.toggle');
    });

    // API endpoint for active sources
    Route::get('/api/order-sources/active', 'OrderSourceController@getActiveSources');


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


    Route::get('/fbads/api/orders-chart', 'FbAdsCon@getOrdersChart');
    Route::get('/fbads/api/order-heatmap', 'FbAdsCon@getOrderHeatmap');
    Route::get('/fbads/api/top-products', 'FbAdsCon@getTopProducts');
    Route::get('/fbads/api/customer-repeat-rate', 'FbAdsCon@getCustomerRepeatRate');
    Route::get('/fbads/api/revenue-comparison', 'FbAdsCon@getRevenueComparison');
    Route::get('dashboard', 'DashboardCon@index')->middleware(['masterAcess']);
    


    Route::resource('fb-ads', 'FbAdsProductController');
    Route::post('/fb-ads/{id}/update-order',  'FbAdsProductController@updateOrder')->name('fb-ads.update-order');

    /*
    |--------------------------------------------------------------------------
    | PRODUCTS Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductsCon@index')->name('products.index');
        Route::get('/add', 'ProductsCon@add');
        Route::post('/store', 'ProductsCon@store');
        Route::get('/update/{id}', 'ProductsCon@update')->name('products.update');
        Route::post('/patch', 'ProductsCon@patch')->name('products.patch');
        Route::post('/delete', 'ProductsCon@delete')->name('products.delete');
        Route::post('/status', 'ProductsCon@status')->name('products.status');
        Route::post('/restore', 'ProductsCon@restore')->name('products.restore');
        Route::get('/archive', 'ProductsCon@archive');

        Route::post('/change-profit', 'ProductsCon@change_profit')->name('products.change_profit');
        Route::post('/change-price', 'ProductsCon@change_price')->name('products.change_price');
        Route::post('/selling-price', 'ProductsCon@selling_price')->name('products.selling_price');

        Route::post('/get-cogs', 'ProductsCon@get_cogs')->name('products.get_cogs');

        
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
        Route::get('/in-out-list', 'InventoryCon@in_out_list');
        Route::get('/stock-in', 'InventoryCon@stock_in')->name('inventory.view');
        Route::get('/stock-in/update/{id}', 'InventoryCon@stock_in_update');
        Route::post('/stock-in/patch', 'InventoryCon@stock_in_patch');
        Route::post('/stock-in/store', 'InventoryCon@stock_in_store');
        Route::post('/stock-in/reflect', 'InventoryCon@reflect');

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
        Route::post('/reflect-stocks', 'PurchaseCon@reflect_stocks');
    });


     /*
    |--------------------------------------------------------------------------
    | Suppliers Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('suppliers')->group(function () {
        Route::get('/', 'SuppliersCon@index')->middleware(['masterAcess']);;
        Route::get('/create', 'SuppliersCon@create');
        Route::post('/store', 'SuppliersCon@store')->name('suppliers.store');
        Route::get('/view/{supplier_id}', 'SuppliersCon@view')->name('suppliers.view');
        Route::get('/details/{supplier_id}', 'SuppliersCon@details')->name('suppliers.details');
        Route::post('/patch', 'SuppliersCon@patch')->name('suppliers.patch');
    });

    Route::prefix('rts')->group(function () {
        Route::get('/', 'RtsCon@index');
        Route::get('/create', 'RtsCon@create');
        Route::post('/store', 'RtsCon@store');
        Route::get('/update/{transaction_id}', 'RtsCon@update')->name('rts.update');
        Route::post('/patch', 'RtsCon@patch')->name('rts.patch');
    });

         /*
    |--------------------------------------------------------------------------
    | Expenses Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('expenses')->group(function () {
        Route::get('/', 'ExpensesCon@index')->name('expenses.index')->middleware(['masterAcess']);;
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
        Route::get('/', 'StoreCon@index')->name('store.index')->middleware(['masterAcess', 'saAccess']);
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
        Route::get('/dashboard', 'FbAdsCon@dashboard')->name('fbads.dashboard');



        Route::get('/meta-metrics', 'FbAdsCon@meta_metrics')->name('fbads.meta_metrics');
        Route::post('/meta-metrics/post', 'FbAdsCon@meta_metrics_post')->name('fbads.meta_metrics.post');
        

        // AJAX Endpoints (String Controller Syntax)
        Route::get('/meta-metrics/data/spend-profit', 'MetaMetricsCon@getSpendProfit')->name('fbads.data.sp');
        Route::get('/meta-metrics/data/roas-per-ad', 'MetaMetricsCon@getRoasPerAd')->name('fbads.data.roas');

        Route::get('/meta-metrics/data/profit-daily', 'MetaMetricsCon@getDailyProfit')->name('fbads.meta_metrics.daily_profit');

        Route::get('/meta-metrics/data/ad-list', 'MetaMetricsCon@getAdList');
        Route::get('/meta-metrics/data/ad-history', 'MetaMetricsCon@getAdHistory');



        Route::get('/meta-metrics/data/ctr-per-ad', 'MetaMetricsCon@getCtrPerAd')->name('fbads.data.ctr');
        Route::get('/meta-metrics/data/roas-trend', 'MetaMetricsCon@getRoasTrend')->name('fbads.data.roasTrend');


        Route::get('/create', 'FbAdsCon@create')->name('fbads.create');
        Route::post('/store', 'FbAdsCon@store')->name('fbads.store');
        Route::get('/order/{id}', 'FbAdsCon@order')->name('fbads.order');
        Route::post('/order/patch', 'FbAdsCon@patch')->name('fbads.order.patch');
        Route::get('/event-listener', 'FbAdsCon@event_listener')->name('fbads.event_listener');
        Route::get('/events', 'FbAdsCon@events')->name('fbads.events');
        Route::post('/change-status', 'FbAdsCon@change_status');

        Route::get('/status-details', 'FbAdsCon@status_details')->name('fbads.status_details');
        Route::post('/status-details/store', 'FbAdsCon@status_details_store')->name('fbads.status_details.store');
        Route::get('/change-status-problematic', 'FbAdsCon@change_status_problematic');


        Route::get('/jandt-reconcile', 'ExcelController@jandt_reconcile')->name("jandt_reconcile");
        Route::post('/jandt-reconcile/process', 'ExcelController@jandt_reconcile_process')->name("jandt_reconcile_process");

    });


    /*
    |--------------------------------------------------------------------------
    | FILE MANAGER
    |--------------------------------------------------------------------------
    */
    Route::prefix('file-manager')->group(function () {
        Route::get('/', 'FileManagerCon@index')->name('file_manager.index');
        Route::post('/add-folder', 'FileManagerCon@add_folder');
        Route::get('/folder/{id}', 'FileManagerCon@folder')->name('file_manager.folder');
        Route::post('/folder/change-name', 'FileManagerCon@change_name')->name('file_manager.folder.change_name');
        Route::POST('/folder/upload', 'FileManagerCon@upload')->name('file_manager.upload');
    });


    /*
    |--------------------------------------------------------------------------
    | LAB
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->group(function () {
        Route::get('/', 'LabCon@index')->name('lab.index');
        Route::get('/inventory', 'LabCon@inventory')->name('lab.inventory');
        Route::get('/chemicals', 'LabCon@chemicals')->name('lab.chemicals');
        Route::post('/create', 'LabCon@create')->name('lab.create');
        Route::get('/update/{id}', 'LabCon@update')->name('lab.update');
        Route::post('/patch/{id}', 'LabCon@patch')->name('lab.patch');
     
        Route::get('/purchase', 'LabCon@purchase')->name('lab.purchase');
        Route::get('/purchase/create', 'LabCon@purchase_create')->name('lab.purchase.create');
        Route::post('/purchase/store', 'LabCon@purchase_store')->name('lab.purchase_store');
        Route::get('/purchase/update/{id}', 'LabCon@purchase_update')->name('lab.purchase.update');
        Route::post('/purchase/patch', 'LabCon@purchase_patch')->name('lab.purchase.patch');


        Route::get('/formulations', 'LabCon@formulations')->name('lab.formulation.index');
        Route::get('/formulations/create', 'LabCon@formulation_create')->name('lab.formulation.create');
        Route::post('/formulations/store', 'LabCon@formulation_store')->name('lab.formulation.store');
        Route::get('/formulations/update/{id}', 'LabCon@formulation_update')->name('lab.formulation.update');
        Route::post('/formulations/patch', 'LabCon@formulation_patch')->name('lab.formulation.patch');
       


        Route::get('/production', 'LabCon@production_index')->name('lab.production.index');
        Route::get('/production/show/{id}', 'LabCon@production_show')->name('lab.production.show');
        Route::get('/production/create/{id}', 'LabCon@production_create')->name('lab.production.create');
        Route::post('/production/store', 'LabCon@production_store')->name('lab.production.store');
    });


    /*
    |--------------------------------------------------------------------------
    | SMS
    |--------------------------------------------------------------------------
    */
    Route::prefix('sms')->group(function () {
        Route::get('/', 'SmsCon@index')->name('sms.index');
        Route::get('/phone-numbers', 'SmsCon@phone_numbers')->name('sms.phone_numbers');
        Route::get('/messages', 'SmsCon@messages')->name('sms.messages');
        Route::get('/messages/{id}', 'SmsCon@message_edit')->name('sms.messages.edit');
        Route::get('/follow-ups', 'SmsCon@follow_ups')->name('sms.follow_ups');
        Route::get('/charts', 'SmsCon@charts')->name('sms.charts');
       
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

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserCon@index')->middleware(['masterAcess']);
        Route::post('/change-role', 'UserCon@role')->middleware(['masterAcess']);
    });

    Route::prefix('withdrawal')->group(function () {
        Route::get('/', 'withdrawalCon@index');
        Route::get('/create', 'withdrawalCon@create');
        Route::post('/store', 'withdrawalCon@store')->name('withdrawal.store');
        Route::post('/status', 'withdrawalCon@status')->name('withdrawal.status');
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