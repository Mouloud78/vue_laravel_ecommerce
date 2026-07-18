<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the products for the size.
     * each size can be in many products and each product can have many sizes, so we use belongsToMany relationship
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
