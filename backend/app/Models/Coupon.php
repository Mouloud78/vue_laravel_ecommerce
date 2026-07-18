<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = ["name", "discount", "valid_until"];

    /**
     * Convert the coupon name to uppercase
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = Str::upper($value);
    }

    /**
     * check if the coupon is not expired
     */
    public function checkIfValid()
    {
        if ($this->valid_until > Carbon::now()) {
            return true;
        } else {
            return false;
        }
    }
}
