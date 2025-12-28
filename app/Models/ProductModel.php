<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'productName',
        'description',
        'price',
        'category_id', // Add this to fillable
        'sku',         // If you added these fields
        'stock_quantity',
        'is_active',
        'image_url',
        'specifications'
    ];

    protected $casts = [
        'price' => 'decimal:2', // Cast price to decimal
        'stock_quantity' => 'integer',
        'is_active' => 'boolean',
        'specifications' => 'array' // Cast JSON to array
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}