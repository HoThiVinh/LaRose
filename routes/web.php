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
Route::post('/profile', 'CustomerController@postProfile');

//Password Reset
Route::get('password/reset',['as'=>'password.reset', 'uses'=>'CustomerController@showLinkRequestForm']);
Route::post('password/email', ['as'=>'password.reset', 'uses'=>'CustomerController@sendResetLinkEmail']);


Route::get('/logout','CustomerController@getLogout');
//contact
Route::get('contact', 'ContactController@getContact');
Route::post('contact', 'ContactController@postContact');
// Category
Route::get('products', 'PageController@getSanPham');
Route::get('products/{id}', ['as'=>'productdetail','uses'=>'PageController@getDetailProduct']);
Route::get('category/{id}/{name}', 'PageController@getListProductByCategoryId');


//cart
Route::get('addproducttocart/{id}/{productname}', ['as'=>'addproducttocart', 'uses'=>'CartController@addItem']);
Route::get('cart', ['as'=>'cart', 'uses'=> 'CartController@getCart']);
Route::get('deleteitem/{id}',['as'=>'deleteitem', 'uses'=>'CartController@deleteItem']);
Route::post('updatecart/{id}/{qty}',['as'=>'updatecart', 'uses'=>'CartController@update']);




//customer
Route::get('/checkout', ['as'=>'checkout', 'uses'=>'OrderController@getCheckout']);
Route::post('/checkout', ['as'=>'checkout', 'uses'=>'OrderController@postCheckout']);

//search
Route::get('/search',  ['as'=>'search', 'uses'=>'PageController@searchProduct']);

Route::post('/review/{id}', 'PageController@postReview');

?>


