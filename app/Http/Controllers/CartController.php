<?php
/**
 * Created by PhpStorm.
 * User: ka
 * Date: 16/04/2017
 * Time: 15:15
 */

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Events\Dispatcher;
use App\Category;
use App\Slide;
use App\Product;
use App\Category_product;
use App\Image;
use App\Manufacturer;
use App\Customer;
use App\Review;
use App\CustomerGroup;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Order;
use App\OrderDetail;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class CartController extends Controller
{
  public function __construct()
  {
    //$this->middleware('customer',['except' => 'getLogout']);
    $category = Category::all();
    $slide = Slide::all();
    $product = Product::all();
    view()->share('category', $category);
    view()->share('slide', $slide);
    view()->share('product', $product);
    $image = Image::all();
    view()->share('image', $image);
    $manufacturer = Manufacturer::all();
    view()->share('manufacturer', $manufacturer);
    $customer = Customer::all();
    view()->share('customer', $customer);
    $order = Order::all();
    view()->share('order', $order);
    $orderDetail = OrderDetail::all();
    view()->share('orderdetail', $orderDetail);


    if(Auth::guard('customer')->check()){
      return view()->share('customerlogin', Auth::guard('customer')->Customer());
    }
    
  }

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
    return redirect()->route('cart');
  }

  public function getCart(){
   $content = Cart::content();
   $subtotal= Cart::subtotal();
   return view('cart.cart', compact('content','subtotal'));
 }

 public function deleteItem($id)
 {
  Cart::remove($id);
  return redirect()->route('cart');
}

public function updateCart(Request $request){
  if($request->ajax()){
    $id = $request::get('id');
    $qty = $request::get('qty');
    Cart::update($id, $qty);
    echo "oke";
  }
}

}