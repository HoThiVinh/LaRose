<?php
/**
 * Created by PhpStorm.
 * User: ka
 * Date: 18/04/2017
 * Time: 13:36
 */

namespace App\Http\Controllers;


use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ReviewController
{

    public function index()
    {
        return Review::all();
    }

    public function show($id)
    {
        return Review::find($id);
    }

    public function store(Request $request)
    {
        $review = new Review();
        $review->customer_id = Input::get('customer_id');
        $review->product_id = Input::get('product_id');
        $review->author = Input::get('author');
        $review->title = Input::get('title');
        $review->text = Input::get('text');
        $review->save();

        return $this->listReviewByProductId($review->product_id);
    }


    public function listReviewByProductId($productId)
    {
        $review = Review::Where('product_id', '=', $productId)->orderBy('created_at', 'desc');
        return $review->get();
    }
}