<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'cart_id',
        'price',

    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);



    }

    public  function product(){

        return $this->belongsToMany(Product::class);


    }


    public  function user(){

        return $this->belongsTo(User::class);


    }


}
