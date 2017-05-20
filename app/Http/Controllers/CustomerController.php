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


class CustomerController extends Controller
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
  
  public function getLogin () {
  return view('customer.login');
}
public function postLogin(Request $request)
{
  $this->validate($request,[
    'email'   => 'required|email',
    'password'  => 'required'
    ],[
    'email.required'    => 'Chưa nhập email',
    'password.required'   => 'Chưa nhập mật khẩu',     
    ]);
  $login = [
  'email' => $request->email,
  'password' => $request->password
  ];

  if(Auth::guard('customer')->attempt($login))
  {
    return redirect('/');
  }
  else {
    return redirect("login")->with('notification', 'Tài khoản hoặc mật khẩu không đúng');
  }
}

public function getRegister() {
 return view('customer.register');
}

public function postRegister(Request $request)
{
  $this->validate($request,[
    'name'    => 'required|min:3|max:32',
    'email'   => 'required|email|unique:customer,email',
    'password'  => 'required|min:4|max:32',
    'passwordAgain' => 'required|same:password',
    'address' =>'required',
    'phone' => 'required'
    ],[
    'name.required'     => 'Chưa nhập họ tên',
    'name.min'        => 'Tên quá ngắn',
    'name.max'        => 'Tên quá dài',
    'email.required'    => 'Chưa nhập email',
    'email.email'       => 'Email không đúng định dạng',
    'email.unique'      => 'Email đã tồn tại',
    'passwordAgain.required' => 'Nhập lại mật khẩu',
    'passwordAgain.same' => 'Mật khẩu không khớp',
    'password.required'   => 'Chưa nhập mật khẩu',
    'password.min'      => 'Mật khẩu quá ngắn',
    'password.max'      => 'Mật khẩu quá dài',
    'address.required'     => 'Chưa nhập địa chỉ',
    'phone.required'     => 'Chưa nhập số điện thoại',
    ]);
  $customer = new Customer;
  $customer->name = $request->input('name');
  $customer->email = $request->input('email');
  $customer->password = bcrypt($request->input('password'));
  $customer->address = $request->input('address');
  $customer->phone = $request->input('phone');
  $customer->bank = $request->input('bank');
  $customer->bank_account = $request->input('bank_account');
  $customer->customer_group_id = 23;
  $customer->note = $request->input('note');   
  $customer->save();
  return redirect('/login')->with('notification', 'Mời bạn đăng nhập tài khoản');
}
public function getLogout() {
  Auth::guard('customer')->logout();
  return redirect('/');
}

public function getProfile()
{
  return view('customer.profile');
}
}