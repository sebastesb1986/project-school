<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable =  [ 'name', 'description' ];

    public $timestamps = false;

    // Relation with product
    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
