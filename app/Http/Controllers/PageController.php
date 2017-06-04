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
use App\Unit;
use App\Tag;
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
use DB;

use Illuminate\Http\Request;

class PageController extends Controller
{
  use AuthenticatesUsers;

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
    $customer = Customer::all();
    view()->share('customer', $customer);
    $order = Order::all();
    view()->share('order', $order);
    $orderDetail = OrderDetail::all();
    view()->share('orderdetail', $orderDetail);
     $unit = Unit::all();
    view()->share('unit', $unit);
     $tag = Tag::all();
    view()->share('tag', $tag);
    $review = Review::all();
    view()->share('review', $review);
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

//Detail Product
public function getDetailProduct($id){
  $product = Product::find($id);
  $unit = Unit::where('id', $product->unit_id)->get();
  $tag = Tag::where('product_id', $id)->get();
  $manufact = Manufacturer::where('id',$product->manufacturer_id)->get();
  $image = Image::where('product_id', $id)->get();
  $product_related = Product::where('category_id',$product->category_id)->where('id','<>',$id)->orderBy('id', 'DESC')->take(4)->get();
  $product_review = Review::where('product_id', $id)->orderBy('created_at')->get();
  return view('product.detail_product',['product' => $product,'product_related' => $product_related, 'image'=>$image,'manufact'=>$manufact, 'product_review'=>$product_review, 'unit'=>$unit, 'tag'=>$tag]);
}
//List Product By Category Id
public function getListProductByCategoryId($id)
{
  $bestsell = DB::table('detail_order')->select(DB::raw('count(product_id) as number, product_id'))->groupBy('product_id')->orderBy('number', 'DESC')->take(4)->get();
  $best_pro = Product::wherein('id',[$bestsell[0]->product_id, $bestsell[1]->product_id, $bestsell[2]->product_id, $bestsell[3]->product_id])->get();
  $product_cate = Product::where('category_id', $id)->paginate(9);

  if(isset($product_cate[0])){
    $cate = Category::where('id',$product_cate[0]->category_id)->first();
    $name_cate = Category::where('id', $id)->first();
    $menu_cate = Category::where('parent_id',$cate->parent_id)->get();
    return view('product.list_product',compact('product_cate','menu_cate', 'cate', 'name_cate', 'best_pro'));
  } else {
    $product = Product::orderBy("created_at")->take(4)->get();
    return view('product.product', compact('product','best_pro'));

  }

}


public function searchProduct(Request $request)
{
  $query =$request->input('key');
  $product = Product::whereRaw('MATCH (name, description) AGAINST (?)', array($query))->paginate(9);
  return view('page.search', compact('product'));
}

public function postReview($id, Request $request)
{
  $product_id = $id;
  $review = new Review();
  $review->product_id = $product_id;
  $review->customer_id =Auth::guard('customer')->user()->id;
  $review->author = Auth::guard('customer')->user()->name;
  $review->title = $request::input('title');
  $review->text = $request::input('text');
  $review->save();

  return redirect()->route('productdetail', $id);

}
}







