<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ["name", 'slug', 'qty', 'price', 'desc', 'thumbnail', 'first_image', 'second_image', 'third_image', 'status', 'category_id', 'brand_id'];

    /*     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /*     * Get the colors for the product.
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    /*     * Get the sizes for the product.
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    /*     * Get the orders for the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /*     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)
            ->with('user')
            ->where('approved', 1)
            ->latest();
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
