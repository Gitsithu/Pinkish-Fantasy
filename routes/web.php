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
/* FrontEnd Location */
Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');


Route::get('/','IndexController@index');
Route::get('/list-products','IndexController@shop');
Route::get('/list-products/maincat/{id}','FilterController@listByMainCat')->name('maincat');
Route::get('/list-products/subcat/{id}','FilterController@listBySubCat')->name('subcat');//17/03HH
Route::get('/list-products/brand/{id}','FilterController@listByBrand')->name('brand');
Route::get('/list-products/filter','FilterController@filter_products')->name('filter');
Route::get('/promotions','FilterController@allPromotions')->name('allpromotions');
Route::get('/promotions/filter','FilterController@specificPromotions')->name('filter_promotions');
////// get Attribute ////////////
Route::get('/get-item-color','IndexController@getColors');
Route::get('/get-item-specs','IndexController@getSpecs');
Route::get('/item-detail/{id}','IndexController@detailitem');
/// Calculator ///
Route::get('/calculator','IndexController@calculator');
/// Simple User Login ///
Route::get('/login_page','UsersController@index');
Route::post('/register_user','UsersController@register');
Route::post('/user_login','UsersController@login')->name('user_login');
Route::get('/logout','UsersController@logout');
Route::get('/autocomplete_item', 'IndexController@autocomplete_item')->name('autocomplete_item');
Route::post('/item_search', 'IndexController@itemSearch');
Route::post('/admin/order/api/{table_name}', array('as' => '/admin/order/api/table_name', 'uses' => 'backend\OrderController@getSpecByItem'));
Route::post('/admin/order/create/api/{table_name}', array('as' => '/admin/order/create/api/table_name', 'uses' => 'backend\OrderController@getTownshipByDivision'));
Route::post('/admin/image/bigger/api/{table_name}', array('as' => '/admin/image/bigger/api/table_name', 'uses' => 'backend\ImageController@getImage'));
/// Simple Pages ///
Route::get('/career','IndexController@career')->name('career');
Route::get('/contact_us','IndexController@contact_us')->name('contact_us');
Route::get('/about_us','IndexController@about_us')->name('about_us');
Route::get('/privacy_policy','IndexController@privacy_policy')->name('privacy_policy');
Route::get('/terms_and_conditions','IndexController@terms_and_conditions')->name('terms_and_conditions');
Route::post('/api/{table_name}', array('as' => '/api/table_name', 'uses' => 'backend\PromotionController@getProductsByStatus'));

Route::get('/delivery','CheckOutController@delivery');
Route::get('/get-townships','CheckOutController@getTownships');

////// User Authentications ///////////
Route::group(['middleware'=>'FrontLogin_middleware'],function (){
    Route::get('/myaccount','UsersController@account');
    Route::put('/update-profile/{id}','UsersController@updateprofile');
    Route::put('/update-password/{id}','UsersController@updatepassword');
    Route::get('/my_favourite','IndexController@showFavourite');
    Route::get('/add_favourite/{id}','IndexController@addFavourite');
    Route::get('/remove_favourite/{id}','IndexController@removeFavourite');
    ///// Cart Area /////////
    Route::get('/viewcart','CheckOutController@viewcart');
    Route::get('/update-instock','CheckOutController@updateInstock');
    /////////////////////////
    Route::get('/check-out','CheckOutController@index');
    Route::post('/submit-checkout','CheckOutController@submitCheckout');
    Route::get('/review-order','CheckOutController@reviewOrder');
    Route::get('/review-order-detail/{id}','CheckOutController@reviewOrderDetail');
    Route::post('/edit-payment-ss/{id}','CheckOutController@editPaymentSS');
    Route::get('/cancel-order/{id}','CheckOutController@cancelOrder');
    Route::get('/get_bank_acc_no','CheckOutController@bank_acc_no');
});
///




/* Admin Location */
Auth::routes(['register'=>false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function (){
    Route::get('/', 'AdminController@index')->name('admin_home');
    /// Setting Area
    Route::get('/settings', 'AdminController@settings');
    Route::get('/check-pwd','AdminController@chkPassword');
    Route::post('/update-pwd','AdminController@updatAdminPwd');
    Route::post('/logout',  array('as'=>'admin/logout','uses'=>'UsersController@adminlogout'));



    /// ///////// Coupons Area //////////
    Route::resource('/coupon','CouponController');
    Route::get('delete-coupon/{id}','CouponController@destroy');
    //own_routes
    // country
    // the routes of country for views, create, update and delete
    Route::get('/country',        			  array('as'=>'admin/country','uses'=>'backend\CountryController@index'));
    Route::get('/country/create',        	  array('as'=>'admin/country/create','uses'=>'backend\CountryController@create'));
    Route::post('/country/store',        	  array('as'=>'admin/country/store','uses'=>'backend\CountryController@store'));
    Route::get('/country/edit/{parameter}',   array('as'=>'admin/country/edit/{parameter}','uses'=>'backend\CountryController@edit'));
    Route::patch('/country/update/{id}',      array('as'=>'admin/country/update/{id}','uses'=>'backend\CountryController@update'));
    Route::get('/country/show/{id}',          array('as'=>'admin/country/show','uses'=>'backend\CountryController@show'));
    Route::get('/country/inactive',           array('as'=>'admin/country/inactive','uses'=>'backend\CountryController@inactive'));
    Route::post('/country/activate',          array('as'=>'admin/country/activate','uses'=>'backend\CountryController@activate'));

    // brand
    // the routes of brand for views, create, update and delete
    Route::get('/brand',        			  array('as'=>'admin/brand','uses'=>'backend\BrandController@index'));
    Route::get('/brand/create',        	      array('as'=>'admin/brand/create','uses'=>'backend\BrandController@create'));
    Route::post('/brand/store',        	      array('as'=>'admin/brand/store','uses'=>'backend\BrandController@store'));
    Route::get('/brand/edit/{parameter}',     array('as'=>'admin/brand/edit/{parameter}','uses'=>'backend\BrandController@edit'));
    Route::patch('/brand/update/{id}',        array('as'=>'admin/brand/update/{id}','uses'=>'backend\BrandController@update'));
    Route::get('/brand/show/{id}',            array('as'=>'admin/brand/show','uses'=>'backend\BrandController@show'));
    Route::get('/brand/inactive',             array('as'=>'admin/brand/inactive','uses'=>'backend\BrandController@inactive'));
    Route::get('/brand/activate/{id}',        array('as'=>'admin/brand/activate/{id}','uses'=>'backend\BrandController@activate'));
    Route::post('/brand/activate',            array('as'=>'admin/brand/activate','uses'=>'backend\BrandController@activate'));

    // category
    // the routes of category for views, create, update and delete
    Route::get('/category',        			  array('as'=>'admin/category','uses'=>'backend\CategoryController@index'));
    Route::get('/category/create',        	  array('as'=>'admin/category/create','uses'=>'backend\CategoryController@create'));
    Route::post('/category/store',        	  array('as'=>'admin/category/store','uses'=>'backend\CategoryController@store'));
    Route::get('/category/edit/{parameter}',  array('as'=>'admin/category/edit/{parameter}','uses'=>'backend\CategoryController@edit'));
    Route::patch('/category/update/{id}',     array('as'=>'admin/category/update/{id}','uses'=>'backend\CategoryController@update'));
    Route::get('/category/show/{id}',         array('as'=>'admin/category/show','uses'=>'backend\CategoryController@show'));
    Route::get('/category/inactive',          array('as'=>'admin/category/inactive','uses'=>'backend\CategoryController@inactive'));
    Route::post('/category/activate',         array('as'=>'admin/category/activate','uses'=>'backend\CategoryController@activate'));

    // main_category
    // the routes of main_category for views, create, update and delete
    Route::get('/main_category',        		  array('as'=>'admin/main_category','uses'=>'backend\MainCategoryController@index'));
    Route::get('/main_category/create',        	  array('as'=>'admin/main_category/create','uses'=>'backend\MainCategoryController@create'));
    Route::post('/main_category/store',        	  array('as'=>'admin/main_category/store','uses'=>'backend\MainCategoryController@store'));
    Route::get('/main_category/edit/{parameter}', array('as'=>'admin/main_category/edit/{parameter}','uses'=>'backend\MainCategoryController@edit'));
    Route::patch('/main_category/update/{id}',    array('as'=>'admin/main_category/update/{id}','uses'=>'backend\MainCategoryController@update'));
    Route::get('/main_category/show/{id}',        array('as'=>'admin/main_category/show','uses'=>'backend\MainCategoryController@show'));
    Route::get('/main_category/inactive',         array('as'=>'admin/main_category/inactive','uses'=>'backend\MainCategoryController@inactive'));
    Route::post('/main_category/activate',        array('as'=>'admin/main_category/activate','uses'=>'backend\MainCategoryController@activate'));

    // sub_category
    // the routes of sub_category for views, create, update and delete
    Route::get('/sub_category',        			  array('as'=>'admin/sub_category','uses'=>'backend\SubCategoryController@index'));
    Route::get('/sub_category/create',        	  array('as'=>'admin/sub_category/create','uses'=>'backend\SubCategoryController@create'));
    Route::post('/sub_category/store',        	  array('as'=>'admin/sub_category/store','uses'=>'backend\SubCategoryController@store'));
    Route::get('/sub_category/edit/{parameter}',  array('as'=>'admin/sub_category/edit/{parameter}','uses'=>'backend\SubCategoryController@edit'));
    Route::patch('/sub_category/update/{id}',     array('as'=>'admin/sub_category/update/{id}','uses'=>'backend\SubCategoryController@update'));
    Route::get('/sub_category/show/{id}',         array('as'=>'admin/sub_category/show','uses'=>'backend\SubCategoryController@show'));
    Route::get('/sub_category/inactive',          array('as'=>'admin/sub_category/inactive','uses'=>'backend\SubCategoryController@inactive'));
    Route::post('/sub_category/activate',         array('as'=>'admin/sub_category/activate','uses'=>'backend\SubCategoryController@activate'));

    // item_specification
    // the routes of item_specification for views, create, update and delete
    Route::get('/item_specification',        			array('as'=>'admin/item_specification','uses'=>'backend\ItemSpecificationController@index'));
    Route::get('/item_specification/create',        	array('as'=>'admin/item_specification/create','uses'=>'backend\ItemSpecificationController@create'));
    Route::post('/item_specification/store',        	array('as'=>'admin/item_specification/store','uses'=>'backend\ItemSpecificationController@store'));
    Route::get('/item_specification/edit/{parameter}',  array('as'=>'admin/item_specification/edit/{parameter}','uses'=>'backend\ItemSpecificationController@edit'));
    Route::patch('/item_specification/update/{id}',     array('as'=>'admin/item_specification/update/{id}','uses'=>'backend\ItemSpecificationController@update'));
    Route::get('/item_specification/show/{id}',         array('as'=>'admin/item_specification/show','uses'=>'backend\ItemSpecificationController@show'));
    Route::get('/item_specification/archive',           array('as'=>'admin/item_specification/archive','uses'=>'backend\ItemSpecificationController@archive'));
    Route::post('/item_specification/store_preorder',        	array('as'=>'admin/item_specification/store_preorder','uses'=>'backend\ItemSpecificationController@store_preorder'));
    Route::post('/item_specification/delete',         array('as'=>'admin/item_specification/delete','uses'=>'backend\ItemSpecificationController@delete'));

    // item
    // the routes of item for views, create, update and delete
    Route::get('/item',        			  array('as'=>'admin/item','uses'=>'backend\ItemController@index'));
    Route::get('/item/create',        	  array('as'=>'admin/item/create','uses'=>'backend\ItemController@create'));
    Route::post('/item/store',        	  array('as'=>'admin/item/store','uses'=>'backend\ItemController@store'));
    Route::get('/item/edit/{parameter}',  array('as'=>'admin/item/edit/{parameter}','uses'=>'backend\ItemController@edit'));
    Route::patch('/item/update/{id}',     array('as'=>'admin/item/update/{id}','uses'=>'backend\ItemController@update'));
    Route::get('/item/show/{id}',         array('as'=>'admin/item/show','uses'=>'backend\ItemController@show'));
    Route::get('/item/archive',           array('as'=>'admin/item/archive','uses'=>'backend\ItemController@archive'));
    Route::get('/item/inactive',           array('as'=>'admin/item/archive','uses'=>'backend\ItemController@inactive'));
    Route::post('/item/activechange',           array('as'=>'admin/item/archive','uses'=>'backend\ItemController@activechange'));
    Route::post('/item/activate',         array('as'=>'admin/item/activate','uses'=>'backend\ItemController@activate'));
    Route::get('/add/specification/{parameter}',  array('as'=>'admin/add/specification/{parameter}','uses'=>'backend\ItemController@add'));
    Route::get('/delete/specification/{parameter}',  array('as'=>'admin/delete/specification/{parameter}','uses'=>'backend\ItemController@delete'));

    // user
    // the routes of user for views, create, update and delete
    Route::get('/user',        			            array('as'=>'admin/user','uses'=>'backend\UserController@index'));
    Route::get('/customer',        			        array('as'=>'admin/customer','uses'=>'backend\UserController@customer'));
    Route::get('/user/create',        	            array('as'=>'admin/user/create','uses'=>'backend\UserController@create'));
    Route::post('/user/store',        	            array('as'=>'admin/user/store','uses'=>'backend\UserController@store'));
    Route::get('/user/deactivate/{parameter}',      array('as'=>'admin/user/deactivate/{parameter}','uses'=>'backend\UserController@deactivate'));
    Route::get('/user/password/{parameter}',        array('as'=>'admin/user/password/{parameter}','uses'=>'backend\UserController@password'));
    Route::post('/user/update/password',            array('as'=>'admin/user/update/password','uses'=>'backend\UserController@updatePassword'));

    //log
    Route::get('/log',  array('as'=>'admin/log','uses'=>'backend\LogController@index'));

    //unauthorize
    Route::get('/unauthorize', array('as'=>'admin/unauthorize','uses'=>'backend\UnauthorizedController@unauthorize'));

    //Order confirmation
    Route::get('/order',        			  array('as'=>'admin/order','uses'=>'backend\OrderController@no'));
    Route::get('/order/deliver',        			  array('as'=>'admin/order/deliver','uses'=>'backend\OrderController@deliver'));
    Route::get('/order/complete',        	  array('as'=>'admin/order/complete','uses'=>'backend\OrderController@complete'));
    Route::post('/order/change',              array('as'=>'admin/order/change','uses'=>'backend\OrderController@change'));
    Route::post('/order/change_2',            array('as'=>'admin/order/change_2','uses'=>'backend\OrderController@change_2'));
    Route::get('/order/detail/{parameter}',   array('as'=>'admin/order/detail/{parameter}','uses'=>'backend\OrderController@detail'));
    Route::get('/order/detail_d/{parameter}',   array('as'=>'admin/order/detail_d/{parameter}','uses'=>'backend\OrderController@detail_d'));
    Route::get('/order/detail_c/{parameter}',   array('as'=>'admin/order/detail_c/{parameter}','uses'=>'backend\OrderController@detail_c'));
    Route::get('/create_order',        	      array('as'=>'admin/create_order','uses'=>'backend\OrderController@create'));
    Route::post('/order/store',        	      array('as'=>'admin/order/store','uses'=>'backend\OrderController@store'));
    Route::patch('/order/confirm/{parameter}', array('as'=>'admin/order/confirm/{parameter}','uses'=>'backend\OrderController@confirm'));
    Route::patch('/order/cancel/{parameter}', array('as'=>'admin/order/cancel/{parameter}','uses'=>'backend\OrderController@cancel'));

    Route::patch('/order/make_deliver/{parameter}',        	      array('as'=>'admin/order/make_deliver/{parameter}','uses'=>'backend\OrderController@make_deliver'));
    Route::patch('/order/make_complete/{parameter}',        	      array('as'=>'admin/order/make_complete/{parameter}','uses'=>'backend\OrderController@make_complete'));
    
    //PreOrder confirmation
    
    Route::get('/preorder',        			  array('as'=>'admin/preorder','uses'=>'backend\PreOrderController@to'));
    Route::get('/preorder/deliver',        	  array('as'=>'admin/preorder/deliver','uses'=>'backend\PreOrderController@deliver'));
    Route::get('/preorder/receive',           array('as'=>'admin/preorder/receive','uses'=>'backend\PreOrderController@receive'));
    Route::get('/preorder/preordered',        array('as'=>'admin/preorder/preordered','uses'=>'backend\PreOrderController@preordered'));
    Route::get('/preorder/completed',        array('as'=>'admin/preorder/completed','uses'=>'backend\PreOrderController@completed'));

    Route::get('/preorder/detail_t/{parameter}',   array('as'=>'admin/preorder/detail_t/{parameter}','uses'=>'backend\PreOrderStatusController@detail_t'));
    Route::get('/preorder/detail_p/{parameter}',   array('as'=>'admin/preorder/detail_p/{parameter}','uses'=>'backend\PreOrderStatusController@detail_p'));
    Route::get('/preorder/detail_r/{parameter}',   array('as'=>'admin/preorder/detail_r/{parameter}','uses'=>'backend\PreOrderStatusController@detail_r'));
    Route::get('/preorder/detail_d/{parameter}',   array('as'=>'admin/preorder/detail_d/{parameter}','uses'=>'backend\PreOrderStatusController@detail_d'));
    Route::get('/preorder/detail_c/{parameter}',   array('as'=>'admin/preorder/detail_c/{parameter}','uses'=>'backend\PreOrderStatusController@detail_c'));

    Route::patch('/preorder/change/{parameter}',              array('as'=>'admin/preorder/change/{parameter}','uses'=>'backend\PreOrderController@change'));
    Route::patch('/preorder/change_2/{parameter}',            array('as'=>'admin/preorder/change_2/{parameter}','uses'=>'backend\PreOrderController@change_2'));
    Route::patch('/preorder/change_3/{parameter}',            array('as'=>'admin/preorder/change_3/{parameter}','uses'=>'backend\PreOrderController@change_3'));
    Route::patch('/preorder/change_4/{parameter}',            array('as'=>'admin/preorder/change_4/{parameter}','uses'=>'backend\PreOrderController@change_4'));

    // Route::post('/preorder/remark/change_1',            array('as'=>'admin/preorder/remark/change_1','uses'=>'backend\PreOrderStatusController@change_1'));
    // Route::post('/preorder/remark/change_2',            array('as'=>'admin/preorder/remark/change_2','uses'=>'backend\PreOrderStatusController@change_2'));
    // Route::post('/preorder/remark/change_3',            array('as'=>'admin/preorder/remark/change_3','uses'=>'backend\PreOrderStatusController@change_3'));
    // Route::post('/preorder/remark/change_4',            array('as'=>'admin/preorder/remark/change_4','uses'=>'backend\PreOrderStatusController@change_4'));
    // Route::post('/preorder/remark/change_5',            array('as'=>'admin/preorder/remark/change_5','uses'=>'backend\PreOrderStatusController@change_5'));

    Route::patch('/preorder/confirm/{parameter}', array('as'=>'admin/preorder/confirm/{parameter}','uses'=>'backend\PreOrderStatusController@confirm'));
    Route::patch('/preorder/cancel/{parameter}', array('as'=>'admin/preorder/cancel/{parameter}','uses'=>'backend\PreOrderStatusController@cancel'));
    // Route::patch('/preorder/confirm_preordered/{parameter}', array('as'=>'admin/preorder/confirm_preordered/{parameter}','uses'=>'backend\PreorderStatusController@confirm_preordered'));
    // Route::patch('/preorder/cancel_preordered/{parameter}', array('as'=>'admin/preorder/cancel_preordered/{parameter}','uses'=>'backend\PreorderStatusController@cancel_preordered'));
    // Route::patch('/preorder/confirm_received/{parameter}', array('as'=>'admin/preorder/confirm_received/{parameter}','uses'=>'backend\PreorderStatusController@confirm_received'));
    // Route::patch('/preorder/cancel_received/{parameter}', array('as'=>'admin/preorder/cancel_received/{parameter}','uses'=>'backend\PreorderStatusController@cancel_received'));
    // Route::patch('/preorder/confirm_delivered/{parameter}', array('as'=>'admin/preorder/confirm_delivered/{parameter}','uses'=>'backend\PreorderStatusController@confirm_delivered'));
    // Route::patch('/preorder/cancel_delivered/{parameter}', array('as'=>'admin/preorder/cancel_delivered/{parameter}','uses'=>'backend\PreorderStatusController@cancel_delivered'));
    // Route::patch('/preorder/confirm_completed/{parameter}', array('as'=>'admin/preorder/confirm_completed/{parameter}','uses'=>'backend\PreorderStatusController@confirm_completed'));
    // Route::patch('/preorder/cancel_completed/{parameter}', array('as'=>'admin/preorder/cancel_completed/{parameter}','uses'=>'backend\PreorderStatusController@cancel_completed'));

    //Order Report
    Route::get('/order_report',        			  array('as'=>'admin/order_report','uses'=>'backend\OrderReportController@index'));
    Route::post('/order_report/search',           array('as'=>'admin/order_report/search','uses'=>'backend\OrderReportController@search'));

    //Instock Report
    Route::get('/instock_report',        			  array('as'=>'admin/instock_report','uses'=>'backend\InstockReportController@index'));
    Route::post('/instock_report/search',           array('as'=>'admin/instock_report/search','uses'=>'backend\InstockReportController@search'));

    //Calculator
    Route::get('/calculator',        			  array('as'=>'admin/calculator','uses'=>'backend\CalculatorController@create'));
    Route::post('/calculator/store',        	  array('as'=>'admin/calculator/store','uses'=>'backend\CalculatorController@store'));

    // profit
    // the routes of brand for views, create, update and delete
    Route::get('/profit',        			   array('as'=>'admin/profit','uses'=>'backend\ProfitController@index'));
    Route::get('/profit/create',        	   array('as'=>'admin/profit/create','uses'=>'backend\ProfitController@create'));
    Route::post('/profit/store',        	   array('as'=>'admin/profit/store','uses'=>'backend\ProfitController@store'));
    Route::get('/profit/edit/{parameter}',     array('as'=>'admin/profit/edit/{parameter}','uses'=>'backend\ProfitController@edit'));
    Route::patch('/profit/update/{id}',        array('as'=>'admin/profit/update/{id}','uses'=>'backend\ProfitController@update'));
    Route::get('/profit/show/{id}',            array('as'=>'admin/profit/show','uses'=>'backend\ProfitController@show'));

    // ui
    // the routes of ui for views, create, update and delete
    Route::get('/ui',        			   array('as'=>'admin/ui','uses'=>'backend\UiConfigController@index'));
    Route::get('/ui/edit/{parameter}',     array('as'=>'admin/ui/edit/{parameter}','uses'=>'backend\UiConfigController@edit'));
    Route::patch('/ui/update/{id}',        array('as'=>'admin/ui/update/{id}','uses'=>'backend\UiConfigController@update'));
    Route::get('/ui/inactive',             array('as'=>'admin/ui/inactive','uses'=>'backend\UiConfigController@inactive'));
    Route::get('/ui/activate/{id}',        array('as'=>'admin/ui/activate/{id}','uses'=>'backend\UiConfigController@activate'));
    Route::post('/ui/activate',            array('as'=>'admin/ui/activate','uses'=>'backend\UiConfigController@activate'));
    ///

    // the routes of service data for views and edit
    Route::get('/service',        			    array('as'=>'admin/service','uses'=>'backend\ServiceConfigController@index'));
    Route::get('/service/edit/{parameter}',     array('as'=>'admin/service/edit/{parameter}','uses'=>'backend\ServiceConfigController@edit'));
    Route::patch('/service/update/{id}',        array('as'=>'admin/service/update/{id}','uses'=>'backend\ServiceConfigController@update'));
    Route::get('/service/inactive',             array('as'=>'admin/service/inactive','uses'=>'backend\ServiceConfigController@inactive'));
    Route::get('/service/activate/{id}',        array('as'=>'admin/service/activate/{id}','uses'=>'backend\ServiceConfigController@activate'));
    Route::post('/service/activate',            array('as'=>'admin/service/activate','uses'=>'backend\ServiceConfigController@activate'));

    // promotion
    Route::get('/promotion',        			  array('as'=>'admin/promotion','uses'=>'backend\PromotionController@index'));
    Route::get('/promotion/create',        	      array('as'=>'admin/promotion/create','uses'=>'backend\PromotionController@create'));
    Route::post('/promotion/store',        	      array('as'=>'admin/promotion/store','uses'=>'backend\PromotionController@store'));
    Route::get('/promotion/edit/{parameter}',     array('as'=>'admin/promotion/edit/{parameter}','uses'=>'backend\PromotionController@edit'));
    Route::patch('/promotion/update/{id}',        array('as'=>'admin/promotion/update/{id}','uses'=>'backend\PromotionController@update'));
    Route::post('/promotion/change',              array('as'=>'admin/promotion/change','uses'=>'backend\PromotionController@change'));
    Route::post('/promotion/change2',             array('as'=>'admin/promotion/change2','uses'=>'backend\PromotionController@change2'));
    Route::get('/promotion/detail/{parameter}',   array('as'=>'admin/promotion/detail/{parameter}','uses'=>'backend\PromotionController@detail'));
    //promocode
    Route::get('/promocode',        			  array('as'=>'admin/promocode','uses'=>'backend\PromoCodeController@index'));
    Route::get('/promocode/create',        	      array('as'=>'admin/promocode/create','uses'=>'backend\PromoCodeController@create'));
    Route::post('/promocode/store',        	      array('as'=>'admin/promocode/store','uses'=>'backend\PromoCodeController@store'));
    Route::get('/promocode/edit/{parameter}',     array('as'=>'admin/promocode/edit/{parameter}','uses'=>'backend\PromoCodeController@edit'));
    Route::patch('/promocode/update/{id}',        array('as'=>'admin/promocode/update/{id}','uses'=>'backend\PromoCodeController@update'));

    //delivery
    Route::get('/delivery',        			     array('as'=>'admin/delivery','uses'=>'backend\DeliveryController@index'));
    Route::get('/delivery/create',        	     array('as'=>'admin/delivery/create','uses'=>'backend\DeliveryController@create'));
    Route::post('/delivery/store',        	     array('as'=>'admin/delivery/store','uses'=>'backend\DeliveryController@store'));
    Route::get('/delivery/edit/{parameter}',     array('as'=>'admin/delivery/edit/{parameter}','uses'=>'backend\DeliveryController@edit'));
    Route::patch('/delivery/update/{id}',        array('as'=>'admin/delivery/update/{id}','uses'=>'backend\DeliveryController@update'));

    // the routes of banks information
    Route::get('/banks_info',        			   array('as'=>'admin/banks_info','uses'=>'backend\BankInformationController@index'));
    Route::get('/banks_info/create',        	   array('as'=>'admin/banks_info/create','uses'=>'backend\BankInformationController@create'));
    Route::post('/banks_info/store',        	   array('as'=>'admin/banks_info/store','uses'=>'backend\BankInformationController@store'));
    Route::get('/banks_info/edit/{parameter}',     array('as'=>'admin/banks_info/edit/{parameter}','uses'=>'backend\BankInformationController@edit'));
    Route::patch('/banks_info/update/{id}',        array('as'=>'admin/banks_info/update/{id}','uses'=>'backend\BankInformationController@update'));
    Route::get('/banks_info/inactive',             array('as'=>'admin/banks_info/inactive','uses'=>'backend\BankInformationController@inactive'));
    Route::get('/banks_info/activate/{id}',        array('as'=>'admin/banks_info/activate/{id}','uses'=>'backend\BankInformationController@activate'));
    Route::post('/banks_info/activate',            array('as'=>'admin/banks_info/activate','uses'=>'backend\BankInformationController@activate'));

    //deli_promo
    Route::get('/deli_promo',        			    array('as'=>'admin/deli_promo','uses'=>'backend\DeliPromoController@index'));
    Route::get('/deli_promo/create',        	    array('as'=>'admin/deli_promo/create','uses'=>'backend\DeliPromoController@create'));
    Route::post('/deli_promo/store',        	    array('as'=>'admin/deli_promo/store','uses'=>'backend\DeliPromoController@store'));
    Route::get('/deli_promo/edit/{parameter}',      array('as'=>'admin/deli_promo/edit/{parameter}','uses'=>'backend\DeliPromoController@edit'));
    Route::patch('/deli_promo/update/{id}',         array('as'=>'admin/deli_promo/update/{id}','uses'=>'backend\DeliPromoController@update'));

    // the routes of contact us
    Route::get('/contact_us',        			   array('as'=>'admin/contact_us','uses'=>'backend\ContactUsController@index'));
    Route::patch('/contact_us/update/{id}',        array('as'=>'admin/contact_us/update/{id}','uses'=>'backend\ContactUsController@update'));

    // the routes of about us
    Route::get('/about_us',        			   array('as'=>'admin/about_us','uses'=>'backend\AboutUsController@index'));
    Route::patch('/about_us/update/{id}',        array('as'=>'admin/about_us/update/{id}','uses'=>'backend\AboutUsController@update'));

});