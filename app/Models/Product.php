<?php

namespace App\Models;

use App\Models\User;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Override;

class Product extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'category_id',
        'subcategory_id',
        'brand_id',
        'image',
        'price',
        'quantity',
        'status',
        'description',
        
    ];

    #[Override]
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {

        return $this->belongsTo(Subcategory::class);
    }

    public function brand()
    {

        return $this->belongsTo(Brand::class);
    }


    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {

        return $query->where(function ($searchQuery) use ($search) {
            $searchQuery->where('name', 'like', "%$search%")
                ->orWhereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', "%$search%");
                })
                ->orWhereHas('subcategory', function ($subcategoryQuery) use ($search) {
                    $subcategoryQuery->where('name', 'like', "%$search%");
                })
                ->orWhereHas('brand', function ($brandQuery) use ($search) {
                    $brandQuery->where('name', 'like', "%$search%");
                });
        });
    }

    #[Override]
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    

}
