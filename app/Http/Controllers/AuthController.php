<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;


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
use App\Cart;
use App\Customer;
use App\Review;
use App\CustomerGroup;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;





use Session;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $cart = Cart::all();
        view()->share('cart', $cart);
        $customer = Customer::all();
        view()->share('customer', $customer);
        if(Auth::check())
        {
            View()->share('customer', Auth::Customer());
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
      $customer->customer_group_id = 1;
      $customer->note = $request->input('note');   
      $customer->save();
      return redirect('/login')->with('notification', 'Mời bạn đăng nhập tài khoản');
  }
    public function getLogout() {
      Auth::guard('customer')->logout();
      return redirect('/');
    }
    
}

