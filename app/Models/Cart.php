<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;




    protected $fillable=[
    /*'product_id'*/'user_id','quantity'
    ];

   /* public function user(){

        return $this->belongsTo(User::class);
    }
    public function product()
    {

        return $this->belongsToMany(Product::class);

    }
*/
    public function order(){


        return $this->hasMany(Order::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }


    public static function add($product, $quantity)
    {
        $cart = new Cart();
        $cart->product_id = $product->id;
        $cart->quantity = $quantity;
        $cart->save();

        return $cart;
    }


    public function cartItem()
    {


    }
}
