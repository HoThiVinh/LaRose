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


class OrderController extends Controller
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

  public function getCheckout(){
  $content = Cart::content();
  $subtotal= Cart::subtotal();
  return view('customer.checkout', compact('content','subtotal'));

}
public function postCheckout(Request $request){
  $content = Cart::content();
  $subtotal= Cart::subtotal();
  $subtotal = (int)$subtotal;


  $customer = new Customer();
  $customer->name = $request->input('name');
  $customer->email = $request->input('email');
  $customer->password = bcrypt($request->input('password'));
  $customer->address = $request->input('address');
  $customer->phone = $request->input('phone');
  $customer->customer_group_id = 23;
  $customer->note = $request->input('note');   
  $customer->bank = $request->input('bank');
  $customer->bank_account = $request->input('bank_account');
  $customer->save();

  $new = new Order();
  $new->created_by = $customer->id;
  $new->customer_id = $customer->id;
  $new->customer_group_id = 1;
  $new->email =$request-> input('email');
  $new->name =$request->input('name');
  $new->address =$request->input('address');
  $new->phone =$request->input('phone');
  $new->total = $subtotal;
  $new->status = 1;
  $new->save();
  foreach ($content as $key => $value) {

    $orderDetail = new OrderDetail();
    $orderDetail->order_id = $new->id;
    $orderDetail->product_id = $value->id;
    $orderDetail->quantity = $value->qty;
    $orderDetail->total = $value->price;
    $orderDetail->save();

    Cart::destroy();


  }
  echo "<script>
   alert('Đơn hàng đã tạo thành công. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. LaRose cảm ơn bạn đã mua hàng');
   window.location = '" .url('./')."'
 </script>";

}
    
}