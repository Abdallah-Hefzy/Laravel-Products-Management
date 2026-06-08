<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

     protected $fillable = [
        'name','slug','category_id','image','created_at','updated_at',
    ];

    public function category(){

    return $this->belongsTo(Category::class);

    }

    public function Products(){

    return $this->hasMany(Product::class);

    }


}
