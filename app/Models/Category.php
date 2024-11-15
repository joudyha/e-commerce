<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public mixed $Products;


    protected $fillable= ['EN_name','AR_name','description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

