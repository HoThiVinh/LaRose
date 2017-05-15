<?php
/**
 * Created by PhpStorm.
 * User: ka
 * Date: 16/04/2017
 * Time: 15:15
 */

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class CartController extends PageController
{
    public function addItem(Request $request, $productId)
{
  $product_buy = Product::where('id',$productId)->first();
  Cart::add(array(
    'id' => $productId,
    'name' => $product_buy->name,
    'qty' =>1,  
    'price' => $product_buy->web_price,
    'options' =>array('img'=>$product_buy->default_image)
    ));
  $content = Cart::content();
  
//dd($content);
    // $oldCart = Session('cart') ? Session::get('cart'):null;
    // $cart = new Cart($oldCart);
    // $cart->add($product, $id);
    // $request->session()->put('cart', $cart);
  return redirect()->route('cart');
}
}