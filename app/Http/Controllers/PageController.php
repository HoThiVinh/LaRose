<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Cart;
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




class PageController extends Controller
{
  use AuthenticatesUsers;

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
    //home
  public function getIndex(){
    $feature_product = Product::orderBy('total_quantity')->take(4)->get();
    $latest_product = Product::orderBy("created_at")->take(4)->get();
    return view('page.index', compact('feature_product','latest_product'));
  }
//contact
  public function getContact()
  {     
   return view('page.contact');
  }
  public function postContact(Request $request)
  {
   $data = [
  'ten'=>Request::input('name'), 
  'emails'=>Request::input('email'),
  'tinnhan'=>Request::input('body')
  ];
  Mail::send('emails.blanks', $data, function ($msg)
  {
    $msg->from('vinhht.1993@gmail.com', 'Hồ Vinh');
    $msg->to('hovinh20122806@gmail.com', 'VinhHT')->subject('Đây là mail Larose');
  });
  echo "<script>
  alert('Cám ơn bạn đã góp ý. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất');
  window.location = '" .url('./')."'
</script>";
}
//Detail Product
public function getDetailProduct($id){
  $product = Product::find($id);
  $manufact = Manufacturer::where('id',$product->manufacturer_id)->get();
  $image = Image::where('product_id', $id)->get();
  $product_related = Product::where('category_id',$product->category_id)->where('id','<>',$id)->orderBy('id', 'DESC')->take(4)->get();
  $product_review = Review::where('product_id', $id)->orderBy('created_at')->get();
    //$product_customer_review = Customer::where('id',$product_review->customer_id)->get();
  return view('product.detail_product',['product' => $product,'product_related' => $product_related, 'image'=>$image,'manufact'=>$manufact, 'product_review'=>$product_review]);
}
//List Product By Category Id
public function getListProductByCategoryId($id)
{
  $product_cate = Product::where('category_id', $id)->paginate(1);
  $cate = Category::where('id',$product_cate[0]->category_id)->first();
  $menu_cate = Category::where('parent_id',$cate->parent_id)->get();
  return view('product.list_product',compact('product_cate','menu_cate', 'cate'));
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

    public function getProfile()
    {
      return view('customer.profile');
    }
    

  public function addItem($productId)
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
    return view('customer.cart', compact('content','subtotal'));
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

  public function getCheckout(){
    $content = Cart::content();
     $subtotal= Cart::subtotal();
    return view('customer.checkout', compact('content','subtotal'));

  }
  public function postCheckout(Request $request){
    $content = Cart::content();
     $subtotal= Cart::subtotal();
   
            $new = new Order();
            $new->created_by = 1;
            $new->customer_id = $request->input('customer_id');
            $new->customer_group_id = 1;
            $new->payment_method =$request-> input('payment_method');
            $new->bank =$request->input('bank');
            $new->bank_account =$request->input('bank_account');

            $new->contact_name =$request->input('name');
            $new->contact_address =$request->input('address');
            $new->contact_phone =$request->input('phone');
            $new->total = 1;
            $new->status = 1;
            $new->save();
            return redirect('/')->with('notification', 'ddđ');
        
  }
}







