<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
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
use Auth;
use Session;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Order;
use App\OrderDetail;
use Cart;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:customer');
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


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
}
