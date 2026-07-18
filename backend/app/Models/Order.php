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
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the coupon that owns the order.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the route key for the model.
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
