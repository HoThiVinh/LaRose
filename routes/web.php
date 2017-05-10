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

Route::get('/','PageController@getIndex');

Route::get('/login','PageController@getLogin');
Route::post('/login','PageController@postLogin');
Route::get('/register', 'PageController@getRegister');
Route::post('/register','PageController@postRegister');
Route::get('/profile', 'PageController@getProfile');

Route::get('/logout','PageController@getLogout');
//contact
Route::get('contact', 'PageController@getContact');
Route::post('contact', 'PageController@postContact');
// Category
Route::get('products', 'PageController@getSanPham');
Route::get('products/{id}', 'PageController@getDetailProduct');
Route::get('category/{id}/{name}', 'PageController@getListProductByCategoryId');


//cart
Route::get('addproducttocart/{id}/{productname}', ['as'=>'addproducttocart', 'uses'=>'PageController@addItem']);
Route::get('cart', ['as'=>'cart', 'uses'=> 'PageController@getCart']);
Route::get('deleteitem/{id}',['as'=>'deleteitem', 'uses'=>'PageController@deleteItem']);
Route::get('updatecart/{id}/{qty}',['as'=>'updatecart', 'uses'=>'PageController@updateCart']);



/**
 * CRUD cart
 */
Route::resource('/carts', 'CartController');
Route::put('/carts/{customer_id}/{product_id}', 'CartController@updateCartByCustomerId');
Route::get('/carts/{customer_id}/customers', 'CartController@listCartByCustomerId');
Route::put('/carts/{customer_id}/{product_id}', 'CartController@updateCartByCustomerId');
Route::delete('/carts/{customer_id}/customer', 'CartController@deleteCartByCustomerId');
Route::delete('/carts/{customer_id}/{product_id}', 'CartController@deleteProductInCart');

//customer
Route::get('/checkout', ['as'=>'checkout', 'uses'=>'PageController@getCheckout']);
Route::post('/checkout', ['as'=>'checkout', 'uses'=>'PageController@postCheckout']);


?>


