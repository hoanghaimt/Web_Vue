<?php

// admin auth 
Route::get('v-admin/dashboard','AdminController@index')->name('admin.dashboard');
Route::get('v-admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('v-admin','Admin\LoginController@login');
Route::post('v-admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('v-admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('v-admin-password/reset','Admin\ResetPasswordController@reset');
Route::get('v-admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::get('v-admin/logout', ['as' => 'v-admin.logout', 'uses' => 'AdminController@logout']);

// API-front-end 
Route::get('apiindex_product', 'PagesController@index_product')->name('index_product');
Route::get('apiget_mod_info_by_slug/{mod_slug}/{list_slug}', 'PagesController@apiget_mod_info_by_slug')->name('apiget_mod_info_by_slug');
Route::post('api_submit_order', 'PagesController@api_submit_order')->name('api_submit_order');
Route::get('api_get_cities', 'PagesController@get_cities')->name('get_cities');
Route::get('get_districts_by_city/{id}', 'PagesController@get_districts_by_city')->name('get_districts_by_city');
Route::get('get_shipping_fee/{id}', 'PagesController@get_shipping_fee')->name('get_shipping_fee');
Route::get('apiget_mod_list_info', 'PagesController@get_mod_list_info')->name('get_mod_list_info');
Route::get('get_mod_listnews_info', 'PagesController@get_mod_listnews_info')->name('get_mod_listnews_info');
Route::get('apigetproduct_in_category/{mod_slug}/{list_slug?}', 'PagesController@getproduct_in_category')->name('getproduct_in_category');
Route::post('api_post_addcart', 'PagesController@api_post_addcart')->name('api_post_addcart');
Route::get('api_get_cart_info', 'PagesController@api_get_cart')->name('api_get_cart');
Route::get('api_get_setting', 'PagesController@api_get_setting')->name('api_get_setting');
Route::post('api_post_removecart_item', 'PagesController@api_post_removecart_item')->name('api_post_removecart_item');
Route::get('api_get_cart_destroy', 'PagesController@api_destroy_cart')->name('api_destroy_cart');
Route::get('/api_chi_tiet/{pro_id}-{pro_slug}', 'PagesController@api_detail_pro')->name('api_detail_pro');
Route::get('/api_tintuc', 'PagesController@api_tintuc')->name('api_tintuc');
Route::get('/api_detail_news/{news_id}-{news_slug}', 'PagesController@api_detail_news')->name('api_detail_news');
// pages routes
Route::get('/', 'PagesController@index')->name('index');
Route::get('/dat-hang', 'PagesController@index')->name('index');
Route::get('/checkout', 'PagesController@index')->name('index');
Route::get('/checkoutmethod', 'PagesController@index')->name('index');
Route::get('/checkout', 'PagesController@index')->name('index');
Route::get('/checkout', 'PagesController@index')->name('index');
Route::get('/dat-hang', 'PagesController@index')->name('index');
Route::get('/san-pham/{list_slug}', 'PagesController@index')->name('index');
Route::get('/san-pham/{list_slug}/{mod_slug}', 'PagesController@index')->name('index');
Route::get('/chi-tiet/{id}-{slug}', 'PagesController@index')->name('index');
Route::get('/tin-tuc', 'PagesController@list_new')->name('listnew');
Route::get('/tin-tuc/{news_id}-{news_slug}', 'PagesController@index')->name('newsinlist');
Route::post('/contact_post', 'PagesController@contact_post')->name('contactpost');

// user auth 
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// api admin - admin info
Route::group(['prefix'=>'api/admins'],function(){
    Route::get('/', ['as' => 'api-admininfo', 'uses' => 'Api\ApiAdmins@getadmin_info']);
    Route::post('/postchange', ['as' => 'api-postchange', 'uses' => 'Api\ApiAdmins@postchange']);
    Route::get('/get_info_dborder', ['as' => 'api-get_info_dborder', 'uses' => 'Api\ApiAdmins@get_info_dborder']);
});
// api admin - admin setting
Route::group(['prefix'=>'api/settings'],function(){
    Route::get('/', ['as' => 'api-get_info_setting', 'uses' => 'Api\SettingController@api_get_setting']);
    Route::post('/save', ['as' => 'api-post_info_setting', 'uses' => 'Api\SettingController@post_info_setting']);
});
// api admin - modproducts
Route::group(['prefix'=>'api/modproducts'],function(){
    Route::get('/', ['as' => 'api-getallmod', 'uses' => 'Api\ApiModProduct@GetAllMod']);
	Route::post('/', ['as' => 'api-postnewmod', 'uses' => 'Api\ApiModProduct@AddNewMod']);
	Route::get('/{id}', ['as' => 'api-getmodbyid', 'uses' => 'Api\ApiModProduct@getmodbyid']);
	Route::post('/{id}', ['as' => 'api-postmodbyid', 'uses' => 'Api\ApiModProduct@UpdateMod']);
	Route::post('remove/{id}', ['as' => 'api-remove', 'uses' => 'Api\ApiModProduct@DeleteMod']);  
});
// api admin - listproducts
Route::group(['prefix'=>'api/listproducts'],function(){    
    Route::get('/', ['as' => 'api-getalllist', 'uses' => 'Api\ApiListProduct@GetAllList']);
	Route::post('/', ['as' => 'api-postnewlist', 'uses' => 'Api\ApiListProduct@AddNewList']);
	Route::get('/getmod', ['as' => 'api-getmod', 'uses' => 'Api\ApiListProduct@getmod']);
	Route::get('/{id}', ['as' => 'api-getlistbyid', 'uses' => 'Api\ApiListProduct@GetListbyid']);
	Route::post('/{id}', ['as' => 'api-postlistbyid', 'uses' => 'Api\ApiListProduct@UpdateList']);
	Route::post('remove/{id}', ['as' => 'api-removelist', 'uses' => 'Api\ApiListProduct@DeleteList']);  
});
// api admin - products
Route::group(['prefix'=>'api/products'],function(){    
    Route::get('/', ['as' => 'api-getallproducts', 'uses' => 'Api\ApiProduct@GetAllProduct']);
	Route::post('/', ['as' => 'api-postnewproducts', 'uses' => 'Api\ApiProduct@AddNewProduct']);
	Route::get('/getmod', ['as' => 'api-getmod', 'uses' => 'Api\ApiProduct@getmod']);
	Route::get('/getlistinmod/{id_mod}', ['as' => 'api-getlistinmod', 'uses' => 'Api\ApiProduct@getlistinmod']);
	Route::get('/renderlistselect/{id_list}', ['as' => 'api-renderlistselect', 'uses' => 'Api\ApiProduct@renderlistselect']);
	Route::get('/edit/{id}', ['as' => 'api-getproductbyid', 'uses' => 'Api\ApiProduct@getproductbyid']);
	Route::post('/{id}', ['as' => 'api-postproductsbyid', 'uses' => 'Api\ApiProduct@UpdateProduct']);
	Route::post('remove/{id}', ['as' => 'api-removeproducts', 'uses' => 'Api\ApiProduct@DeleteProduct']);  
});
// api admin - modnews
Route::group(['prefix'=>'api/modnews'],function(){
    Route::get('/', ['as' => 'api-getallmod', 'uses' => 'Api\ApiModNews@GetAllMod']);
	Route::post('/', ['as' => 'api-postnewmod', 'uses' => 'Api\ApiModNews@AddNewMod']);
	Route::get('/{id}', ['as' => 'api-getmodbyid', 'uses' => 'Api\ApiModNews@getmodbyid']);
	Route::post('/{id}', ['as' => 'api-postmodbyid', 'uses' => 'Api\ApiModNews@UpdateMod']);
	Route::post('remove/{id}', ['as' => 'api-remove', 'uses' => 'Api\ApiModNews@DeleteMod']);  
});
// api admin - listnews
Route::group(['prefix'=>'api/listnews'],function(){    
    Route::get('/', ['as' => 'api-getalllist', 'uses' => 'Api\ApiListNews@GetAllList']);
	Route::post('/', ['as' => 'api-postnewlist', 'uses' => 'Api\ApiListNews@AddNewList']);
	Route::get('/getmod', ['as' => 'api-getmod', 'uses' => 'Api\ApiListNews@getmod']);
	Route::get('/{id}', ['as' => 'api-getlistbyid', 'uses' => 'Api\ApiListNews@GetListbyid']);
	Route::post('/{id}', ['as' => 'api-postlistbyid', 'uses' => 'Api\ApiListNews@UpdateList']);
	Route::post('remove/{id}', ['as' => 'api-removelist', 'uses' => 'Api\ApiListNews@DeleteList']);  
});
// api admin - news
Route::group(['prefix'=>'api/news'],function(){    
    Route::get('/', ['as' => 'api-getallnews', 'uses' => 'Api\ApiNews@GetAllProduct']);
	Route::post('/', ['as' => 'api-postnewnews', 'uses' => 'Api\ApiNews@AddNewProduct']);
	Route::get('/getmod', ['as' => 'api-getmod', 'uses' => 'Api\ApiNews@getmod']);
	Route::get('/getlistinmod/{id_mod}', ['as' => 'api-getlistinmod', 'uses' => 'Api\ApiNews@getlistinmod']);
	Route::get('/renderlistselect/{id_list}', ['as' => 'api-renderlistselect', 'uses' => 'Api\ApiNews@renderlistselect']);
	Route::get('/edit/{id}', ['as' => 'api-getproductbyid', 'uses' => 'Api\ApiNews@getproductbyid']);
	Route::post('/{id}', ['as' => 'api-postnewsbyid', 'uses' => 'Api\ApiNews@UpdateProduct']);
	Route::post('remove/{id}', ['as' => 'api-removenews', 'uses' => 'Api\ApiNews@DeleteProduct']);  
});
// api admin - order
Route::group(['prefix'=>'api/order'],function(){    
	Route::post('addpro_to_order', ['as' => 'api-addpro_to_order', 'uses' => 'Api\ApiOrderController@addpro_to_order']);
    Route::get('/', ['as' => 'api-getallorder', 'uses' => 'Api\ApiOrderController@getorderlist']);
	Route::post('/', ['as' => 'api-postneworder', 'uses' => 'Api\ApiOrderController@AddNew']);
	Route::get('/edit/{id}', ['as' => 'api-getproductbyid', 'uses' => 'Api\ApiOrderController@getbyid']);
	Route::post('/update', ['as' => 'api-postupdatestatus', 'uses' => 'Api\ApiOrderController@postupdatestatus']);
	Route::post('/{id}', ['as' => 'api-postnewsbyid', 'uses' => 'Api\ApiOrderController@UpdateProduct']);
	Route::post('remove/{id}', ['as' => 'api-removenews', 'uses' => 'Api\ApiOrderController@Deleteorder']);  
	Route::post('pro_remove/{id}', ['as' => 'api-removenews', 'uses' => 'Api\ApiOrderController@remove_product']);  
	Route::get('getproductlist/{o_id}', ['as' => 'api-rgetproductlist', 'uses' => 'Api\ApiOrderController@getproductlist']);  
	Route::get('getpro_inlist/{list_id}', ['as' => 'api-getpro_inlist', 'uses' => 'Api\ApiOrderController@getpro_inlist']);  
	Route::get('getmodlist', ['as' => 'api-getmodlist', 'uses' => 'Api\ApiOrderController@getmodlist']); 
	Route::get('order_his', ['as' => 'api-order_his', 'uses' => 'Api\ApiOrderController@order_his']); 
	  
});