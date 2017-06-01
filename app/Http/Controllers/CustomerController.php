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


use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;


class CustomerController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
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

  //Password Reset
  use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLinkRequestForm()
    {
      return view('customer.reset');
    }
    public function sendResetLinkEmail(Request $request)
    {
      $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
      $response = $this->broker()->sendResetLink(
        $request->only('email')
        );

      return $response == Password::RESET_LINK_SENT
      ? $this->sendResetLinkResponse($response)
      : $this->sendResetLinkFailedResponse($request, $response);
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

//Thông tin cá nhân khách hàng
  public function getProfile()
  {
   
    $customerlogin = Auth::guard('customer')->user();
    $order = Order::where('customer_id', $customerlogin->id)->orderBy("created_at", 'desc')->get();

    $orderdetail = array();
    for($i = 0; $i<count($order); $i++) {
      $orderdetailItem = OrderDetail::where('order_id', $order[$i]->id)->get();
      array_push($orderdetail, $orderdetailItem);

    }

    $product = array();
    for ($j=0; $j <count($orderdetail) ; $j++) { 
      for ($j=0; $j <count($orderdetail) ; $j++) {
        $productItem = array();
        foreach ($orderdetail[$j] as $item) {
         $subProductItem = Product::where('id',$item->product_id)->get();
         array_push($productItem, $subProductItem);   
         
       }
       array_push($product, $productItem);
     }


   }
  return view('customer.profile', compact('customerlogin','order','orderdetail', 'product'));

 }

 public function postProfile(Request $request)
 {
  $this->validate($request,[
    'name'    => 'required|min:3|max:32',
    'email'   => 'required|email',
    'address' =>'required',
    'phone' => 'required'
    ],[
    'name.required'     => 'Chưa nhập họ tên',
    'name.min'        => 'Tên quá ngắn',
    'name.max'        => 'Tên quá dài',
    'email.required'    => 'Chưa nhập email',
    'email.email'       => 'Email không đúng định dạng',
    'address.required'     => 'Chưa nhập địa chỉ',
    'phone.required'     => 'Chưa nhập số điện thoại',
    ]);
  $customer = Auth::guard('customer')->user();
  $customer->name = $request->name;
  $customer->email = $request->email;
  if($request->changePassword == "on")
  {
    $this->validate($request,[
      'password'  => 'required|min:4|max:32',
      'passwordAgain' => 'required|same:password',
      ],[
      'passwordAgain.required' => 'Nhập lại mật khẩu',
      'passwordAgain.same' => 'Mật khẩu không khớp',
      'password.required'   => 'Chưa nhập mật khẩu',
      'password.min'      => 'Mật khẩu quá ngắn',
      'password.max'      => 'Mật khẩu quá dài',
      ]);
    $customer->password = bcrypt($request->password);
  }
  $customer->address = $request->address;
  $customer->phone = $request->phone;
  $customer->bank = $request->bank;
  $customer->bank_account = $request->bank_account;
  $customer->customer_group_id = 23;
  $customer->note = $request->note;   
  $customer->save();

  return redirect('/profile')->with('notification', 'Tài khoản của bạn đã cập nhật thành công');
}
}