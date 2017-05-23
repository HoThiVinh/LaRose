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
Route::get('/aboutus', 'PageController@getAboutUs');

Route::get('/login','CustomerController@getLogin');
Route::post('/login','CustomerController@postLogin');
Route::get('/register', 'CustomerController@getRegister');
Route::post('/register','CustomerController@postRegister');
Route::get('/profile', 'CustomerController@getProfile');

Route::get('/logout','CustomerController@getLogout');
//contact
Route::get('contact', 'PageController@getContact');
Route::post('contact', 'PageController@postContact');
// Category
Route::get('products', 'PageController@getSanPham');
Route::get('products/{id}', 'PageController@getDetailProduct');
Route::get('category/{id}/{name}', 'PageController@getListProductByCategoryId');


//cart
Route::get('addproducttocart/{id}/{productname}', ['as'=>'addproducttocart', 'uses'=>'CartController@addItem']);
Route::get('cart', ['as'=>'cart', 'uses'=> 'CartController@getCart']);
Route::get('deleteitem/{id}',['as'=>'deleteitem', 'uses'=>'CartController@deleteItem']);
Route::get('updatecart/{id}/{qty}',['as'=>'updatecart', 'uses'=>'CartController@updateCart']);

//customer
Route::get('/checkout', ['as'=>'checkout', 'uses'=>'OrderController@getCheckout']);
Route::post('/checkout', ['as'=>'checkout', 'uses'=>'OrderController@postCheckout']);

//search
Route::get('/search',  ['as'=>'search', 'uses'=>'PageController@searchProduct']);

Route::post('/review/{id}', 'PageController@postReview');

?>


