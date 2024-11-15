<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;


    /**
     * Display a listing of the resource.
     */



class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return response()->json([
            'products' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $categoryId = $request->input('category');
        $searchTerm = $request->input('search');
        $products = Product::query();

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        if ($searchTerm) {
            $products->where(function ($query) use ($searchTerm) {
                $query->where('EN_name', 'like', "%$searchTerm%")
                    ->orWhere('AR_name', 'like', "%$searchTerm%");
            });
        }

        $products = $products->get();

        return response()->json([
            'products' => $products,
        ]);
    }










    /*
        public function search(Request $request)
        {
            $categoryId = $request->input('category');
            $products = Product::query();

            if ($categoryId) {
                $products->where('category_id', $categoryId);
            }

            $products = $products->get();

            return response()->json([
                'products' => $products,
            ]);
        }*/


    /*public function index()
    {
        $products=Product::all();
        return response()->json(['data'=>$products]);
    }*/

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'EN_name' => 'required',
            'AR_name' => 'required',
            'AR_Description' => 'required',
            'EN_Description'=>'required',
            'price' => 'required',
            'quantity' => 'required',
            'image',
            'images',
            'category_id' => 'required',
        ]);
        $product = Product::create($validatedData);
        return redirect('/products')->with($product, 'product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find(intval($id));
        if (!$products) {
            return response()->json(['message' => 'product not found'], 404);
        }
        return response()->json(['data' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Product::find($id);
        if (!$products) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $products->update($request->all());
        return response()->json(['data' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::find($id);
        if (!$products) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $products->delete();
        return response()->json(['message' => 'product deleted'], 200);
    }


    public function addRating(Request $request, $id)
    {
        $product = Product::find($id);

        // التحقق من صحة البيانات المدخلة من قبل المستخدم
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $rating = new Rating;
        $rating->product_id = $product->id;
        $rating->rating = $validatedData['rating'];
        $rating->save();

        return response()->json(['message' => 'Rating added successfully'], 200);
    }





    public function showRatings($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($id);
        $ratings = $product->ratings;
        return response()->json($ratings, 200);
    }


    public function deleteRating($id)
    {
        $rating = Rating::find($id);
        $rating->delete();

        return response()->json(['message' => 'Rating deleted successfully'], 200);
    }



}
