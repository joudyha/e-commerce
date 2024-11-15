<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{




    public function addToCart(Request $request, $id)
    {
        $cart = new Cart;
        $cart->user_id = auth()->id();
        $cart->product_id = $id;
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return response()->json([
            'message' => 'تمت إضافة المنتج إلى السلة بنجاح'
        ]);
    }





  /*  public function updateCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $cart = (new \App\Models\Cart)->update()->[($product, $request->input('quantity')];

        return response()->json(['message' => 'Cart updated.', 'cart' => $cart], 200);
    }*/
    public function updateCart(Request $request, $id)
    {
       // $cart=new Cart();
        $user=User::find($request->input('user_id'));
        $cartItem = Cart::findOrFail($id);


        $cartItem->user_id = $user->id;
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([$cartItem,'message'=>'updated cart successfully'],200);
    }



    public function addOrderToCart(Request $request,$user_id)
    {
        $user =User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }


        $cartId = $request->input('cart_id');

        $productId = $request->input('product_id');

        $order = new Order();
        $order->user_id = $user_id;
        $order->product_id = $productId;
        $order->cart_id=$cartId;
        $order->save();

        return response()->json(['message' => 'Order added to cart']);
    }





    public function createCart($id)
    {
        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'المستخدم غير موجود'], 404);
        }

        $cart = Cart::create(['user_id' => $user->id]);

        return response()->json(['message' => 'تم إنشاء سلة جديدة بنجاح', 'cart_id' => $cart->id], 200);
    }










    /*  public function removeCart(Request $request, $id)
      {
          $product = Product::find($id);
          if (!$product) {
              return response()->json(['message' => 'Product not found.'], 404);
          }

          Cart::remove($product);

          return response()->json(['message' => 'Product removed from cart.'], 200);
      }*/


    public function removeCart($id)
    {
        $cartItem = Cart::find($id);
        $cartItem->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from cart successfully.',
        ]);
    }


    public function showCart()
    {
        $cartItems = Cart::all();
        return response()->json($cartItems);
    }
/*
    public function Checkout($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

68

        foreach ($cart->products as $product){
            if ($product->quantity <= 0) {
                return response()->json(['error' => 'Product out of stock.'], 400);
            }

            $product->quantity--;
            $product->save();
        }

        $cart->delete();

        return response()->json(['message' => 'Thank you for your purchase.'], 200);
    }*/
}






