<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
  /*public function store(Request $request)
{

    $validatedData = $request->validate([
        'rating' => 'required|integer|max:5',
        'product_id' => 'required',
        'user_id' => 'required',
        'comment'=>'required',

    ]);
    $rating = Rating::create($validatedData);
    return redirect('/rating')->with('success', 'rating created successfully!');
}*/
}
