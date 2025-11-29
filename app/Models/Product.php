<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'image',
        'category_name',
        'category_id',
        'quantity',
        'price',
        'discount_price'
    ];
    
    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }
    
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
    
    public function getRatingCountAttribute()
    {
        return $this->reviews()->count();
    }
}