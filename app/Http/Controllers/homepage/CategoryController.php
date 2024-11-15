<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function search(Request $request)
    {
        $CategoryName = $request->input('category_name');
        $categories = Category::where('EN_name', 'like', '%' .$CategoryName. '%')->orWhere('AR_name', 'like', '%' .$CategoryName. '%')->get();
        return response()->json($categories);


    }


    public function index()
    {
        $categories = Category::all();
        return response()->json(['data' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { $validatedData=$request->validate([
        'EN_name'=>'required',
        'AR_name'=>'required',
        'description'=>'required',
        ]);

        $categories = Category::create($validatedData);
        return redirect('/category')->with('success','category created successfully!');}

    /**        $product=Product::create($validatedData);
    return redirect('/products')->with('success','product created successfully!');
    }
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::find($id);
        if (!$categories) {
            return response()->json(['message' => 'category not found'], 404);
        }

        return response()->json(['data' => $categories]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // استرداد التصنيف الحالي
        $category = Category::find($id);

        // تحديث التصنيف
        $category->EN_name = $request->input('EN_name');
        $category->AR_name = $request->input('AR_name');

        $category->description = $request->input('description');
        $category->save();

        // إعادة توجيه المستخدم
        return redirect()->route('category.index')->with('success', 'تم تحديث التصنيف بنجاح!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'category deleted']);

    }

}
