<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::all();
    }

    public function store(Request $request)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = Input::get('order_id');
        $orderDetail->product_id = Input::get('product_id');
        $orderDetail->total = Input::get('total');
        $orderDetail->quantity = Input::get('quantity');
        $orderDetail->save();

        return OrderDetail::find($orderDetail->id);
    }

    // Xem danh sách chi tiết đơn hàng
    public function listOrderDetailByOrderId($orderId)
    {
        $orderDetail = OrderDetail::Where('order_id', $orderId)->with('product')->orderBy('created_at', 'desc');
        return $orderDetail->get();
    }

    public function updateOrderDetailByProductId($orderId, $productId)
    {
        $orderDetail = OrderDetail::Where('order_id', $orderId)->where('product_id', $productId)->firstOrFail();
        $orderDetail->quantity = Input::get('quantity');
        $orderDetail->total = Input::get('total');
        $orderDetail->save();

        return OrderDetail::find($orderId);
    }
}
