<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable =  [ 'name', 'description', 'quantity', 'category_id' ];

    public $timestamps = false;

    // Relationship with categories
    public function categories()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

}
