<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Review extends Model
{
    protected $fillable = ["title", "body", "rating", "user_id", "product_id", "approved"];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that owns the review.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getCreatedAtAttribute(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return Carbon::parse($value)->diffForHumans();
    }
}
