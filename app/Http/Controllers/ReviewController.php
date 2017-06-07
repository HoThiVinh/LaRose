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
use Request;

class ReviewController extends Controller
{

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
