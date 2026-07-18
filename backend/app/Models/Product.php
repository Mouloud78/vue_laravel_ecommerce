<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ["name", 'slug', 'qty', 'price', 'desc', 'thumbnail', 'first_image', 'second_image', 'third_image', 'status', 'category_id', 'brand_id'];

    /**
     *  Get the category that owns the product.
     * each product belongs to one category, so we use belongsTo relationship
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     * each product belongs to one brand, so we use belongsTo relationship
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /** 
     * Get the colors for the product.
     * each product can have many colors and each color can be in many products, so we use belongsToMany relationship
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    /** 
     * Get the sizes for the product.
     * each product can have many sizes and each size can be in many products, so we use belongsToMany relationship
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    /** 
     * Get the orders for the product.
     * each product can be in many orders and each order can have many products, so we use belongsToMany relationship
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     *  Get the reviews for the product.
     * each product can have many reviews and each review belongs to one product, so we use hasMany relationship
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
