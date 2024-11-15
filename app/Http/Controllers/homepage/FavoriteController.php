<?php

namespace App\Http\Controllers\homepage;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
class FavoriteController extends Controller
{
    public function addToFavorites(Request $request)
        {
            if (auth()->check()) {
                $user = auth()->user();


            $product = Product::find($request->input('product_id'));


            if ($user->favorites()->where('product_id', $product->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product already exists in favorites.',
                ]);
            }

            // إضافة المنتج إلى قائمة مفضلات المستخدم
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->product_id = $product->id;
            $favorite->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to favorites successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to add product to favorites.',
            ]);
        }
    }



   /* public function index(){

        $favorites =Favorite::all();
        return response()->json([
            'status'=>'success',
            'data'=>$favorites
        ]);


    }*/

    public function index(){
        if (auth()->check()) {
            $user = auth()->user();
            $favorites=$user->favorites()->get();
            $favorite=Favorite::all();
            return response()->json([
                'status'=>'success',
                'data'=>$favorite,$favorites
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to view your favorites.',
            ]);
        }
    }


public function delete(Request$request)
{

        $favorite=Favorite::find($request->input('favorite_id'));
        $favorite->delete();

    return response()->json(['message' => 'favorite deleted successfully'], 200);
}


    public function deleteFromFavorites(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $product = Product::find($request->input('product_id'));

            if ($user->favorites()->where('product_id', $product->id)->exists()) {
                $user->favorites()->where('product_id', $product->id)->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product removed from favorites successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product does not exist in favorites.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to remove product from favorites.',
            ]);
        }
    }
}
