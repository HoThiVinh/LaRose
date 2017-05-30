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

class ContactController extends Controller
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

	public function getContact()
	{      
		$customerlogin = Auth::guard('customer')->user();
		return view('page.contact', compact('customerlogin'));
	}
	public function postContact(Request $request)
	{
		if(Auth::guard('customer')->check()){
			$data = [
			'ten'=> Auth::guard('customer')->user()->name, 
			'emails'=>Auth::guard('customer')->user()->email,
			'tinnhan'=>Request::input('body')
			];
		}
		else{
			$data = [
			'ten'=>Request::input('name'), 
			'emails'=>Request::input('email'),
			'tinnhan'=>Request::input('body')
			];
		}
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
}
