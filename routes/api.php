<?php

use Illuminate\Http\Request;



///////////////////////////
/// ADMIN PANEL 
///////////////////////

///////
/// SERVICE API
////////////////

Route::post('admin/service/store',['uses' => 'admin\serviceController@store']);
Route::get('admin/service/index',['uses' => 'admin\serviceController@index']);
Route::get('admin/service/destroy/{id}',['uses' => 'admin\serviceController@destroy']);
Route::post('admin/service/update/image/{id}','admin\serviceController@updateImage');
Route::post('admin/service/update/{id}','admin\serviceController@update');


//////////////////////////
////////// Sub Service API
/////////////////////

Route::post('admin/sub_service/store','admin\subServiceController@store');
Route::get('admin/sub_service/index','admin\subServiceController@index');
Route::get('admin/sub_service/destroy/{id}','admin\subServiceController@destroy');
Route::post('admin/sub_service/update/image/{id}','admin\subServiceController@updateImage');
Route::post('admin/sub_service/update/{id}','admin\subServiceController@update');



//////////////////////
/// Price
///////////

Route::post('admin/price/store','admin\priceController@store');
Route::get('admin/price/index','admin\priceController@index');
Route::post('admin/price/update/{id}','admin\priceController@update');
Route::get('admin/price/destroy/{id}','admin\priceController@destroy');


///////////////
///// Orders
//////////
Route::get('admin/orders/index','admin\orderController@index');
Route::get('/admin/order/subService/{id}','admin\orderController@subServiceShow');
Route::get('/admin/order/show/{id}','admin\orderController@show');
Route::get('/admin/order/price/{id}/{order_id}','admin\orderController@orderPriceGet');
Route::post('/admin/order/approve/{id}','admin\orderController@approveOrder');

/////////////
//// Approve Order
/////////

Route::get('admin/approve/orders/index','admin\orderController@indexApprove');
Route::get('/admin/approve/order/subService/{id}','admin\orderController@subServiceShowApprove');
Route::get('/admin/approve/order/show/{id}','admin\orderController@showApprove');
Route::get('/admin/approve/order/price/{id}/{order_id}','admin\orderController@orderPriceGetApprove');
Route::get('admin/complate/orders/index','admin\orderController@indexApprove');

///////////
////// Driver Controller
///////////

Route::post('admin/driver/store','admin\driverController@reg');
Route::get('admin/driver/index','admin\driverController@index');




//////////////////// 
/////// Driver App Controller
/////////////////////////////////////

/// User Controller
//////
Route::post('driver/login','driver\userController@login');



////////////////////////
/// APP API
///////////////////

Route::post('user/register','api\userController@reg');
Route::post('user/login','api\userController@login');



/////////////
//////// Auth
///////////////


Route::group(['middleware' => 'auth:api'], function(){

/////////////////////
///// AUTH
//////
//////////////
	/// User
	////////
	Route::get('user/details','api\userController@details');
	Route::post('user/changePassword','api\userController@changePassword');
	/////////
	//// Services
	///////
	Route::get('services/index','api\serviceController@index');
	Route::get('services/show/SubService/{id}','api\serviceController@show');

	//////////
	/// User Service
	/////////
	Route::post('user/service/store','api\userServiceController@store');
	Route::get('user/service/index','api\userServiceController@index');
	Route::get('user/service/sub_service/show/{id}','api\userServiceController@show');
	Route::get('user/service/show/{id}','api\userServiceController@show');

	//////////
	/// Price
	/////
	Route::post('user/service/price/save/{id}','api\userNumberController@save');

	////////
	/// order
	/////////
	Route::post('user/order/store','api\orderController@store');


	////////////////
	/// Check Out
	//////////
	Route::get('user/checkout/fetchUserBags','api\checkoutController@fetchUserBags');
	Route::get('/user/checkout/service/show/{id}','api\checkoutController@showServicePrice');


	// my Order
	Route::get('/myOrder/index','api\myOrderController@index');
	Route::get('/myOrder/showBags/{id}','api\myOrderController@myBags');
	Route::get('/myOrder/showNumbers/{id}/{order_id}','api\myOrderController@myNumbers');
	Route::get('/myOrder/destroy/{id}','api\myOrderController@destroy');








	/////////////////////////////////////
	////////////////// Driver Controller
	///////////////////////////////////////////

	////// Order Controller
	///////////
	Route::get('driver/index','driver\orderController@index');
	Route::get('driver/showUser/{id}','driver\orderController@showUser');
	Route::get('driver/show/{id}','driver\orderController@show');
	Route::get('driver/order/complate/{id}','driver\orderController@complateOrder');

});