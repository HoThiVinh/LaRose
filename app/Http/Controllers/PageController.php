<?php

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
use Request;




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

  public function getAboutUs(){
    return view('page.aboutus');
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
  return view('product.detail_product',['product' => $product,'product_related' => $product_related, 'image'=>$image,'manufact'=>$manufact, 'product_review'=>$product_review]);
}
//List Product By Category Id
public function getListProductByCategoryId($id)
{
  $product_cate = Product::where('category_id', $id)->paginate(2);

  if(isset($product_cate[0])){
    $cate = Category::where('id',$product_cate[0]->category_id)->first();
    $name_cate = Category::where('id', $id)->first();
    $menu_cate = Category::where('parent_id',$cate->parent_id)->get();
    return view('product.list_product',compact('product_cate','menu_cate', 'cate', 'name_cate'));
  } else {
    $product = Product::orderBy("created_at")->take(4)->get();
    return view('product.product', compact('product'));

  }

}


public function searchProduct(Request $request)
{
  $query =$request->input('key');
  $product = Product::whereRaw('MATCH (name, description) AGAINST (?)', array($query))->paginate(1);
  return view('page.search', compact('product'));
}
}







