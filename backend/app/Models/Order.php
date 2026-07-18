<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["qty", 'total', 'delivered_at', 'user_id', 'coupon_id'];

    /**
     * Get the products for the order.
     * each product can be in many orders and each order can have many products, so we use belongsToMany relationship
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Get the user that owns the order.
     * each order belongs to one user, so we use belongsTo relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the coupon that owns the order.
     * each order belongs to one coupon, so we use belongsTo relationship
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the route key for the model.
     * humain readable format for the created_at attribute
     *
     * @return string
     */
    public function getCreatedAtAttribute(?string $value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getDeliveredAtAttribute(?string $value)
    {
        if ($value) {
            return Carbon::parse($value)->diffForHumans();
        } else {
            return null;
        }
    }
}
