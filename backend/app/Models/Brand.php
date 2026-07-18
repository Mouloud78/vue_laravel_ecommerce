<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * Get the products for the brand.
     * each brand can have many products, so we use hasMany relationship
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return "slug";
    }
}
