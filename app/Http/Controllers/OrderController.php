<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{/*
    public function addOrderToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cartId = $request->input('cart_id');

        $userId = Auth::id();

        $order = new Order();
        $order->user_id = $userId;
        $order->cart_id =$cartId;
        $order->product_id = $productId;
        $order->save();

        return response()->json(['message' => 'Order added to cart']);
    }*/
}
