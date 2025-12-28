<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Specify the table name (matches your migration)
    protected $table = 'category';

    // Define fillable fields exactly as in your table
    protected $fillable = [
        'name',
        'description',
        'price' // Stored as string as per your migration
    ];


    public function  prodct()
    {
        return $this->hasMany(ProductModel::class);
    }
    // No casting for price since it's a string field
    // This means price will be treated as plain text
}
