<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the products for the color.
     * each color can be in many products and each product can have many colors, so we use belongsToMany relationship
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
