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
}