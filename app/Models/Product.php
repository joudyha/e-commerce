<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{



    use HasFactory;

    protected $fillable =['EN_name','AR_name','AR_Description','EN_Description','price','quantity','image','images','category_id','user_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);



    }

    public function favorite(){

     return  $this->hasMany(Favorite::class);

   }


    public function cart()
    {

        return $this->hasMany(Cart::class);
    }


   public function user(){

        return $this->belongsTo(User::class);}
public function order(){
return $this->hasMany(Order::class);
}}


