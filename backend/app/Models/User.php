<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'zip_code',
        'country',
        'phone_number',
        'profile_image',
        'profile_completed'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $appends = [
        'image_path',
    ];

    /**
     * Get the orders for the user.
     * each user can have many orders, so we use hasMany relationship
     */
    public function orders()
    {
        return $this->hasMany(Order::class)
            ->with('products')
            ->latest();
    }

    /**
     * Get the reviews for the user.
     * each user can have many reviews, so we use hasMany relationship
     */
    public function getImagePathAttribute()
    {
        if ($this->profile_image) {
            /**
             * return full path of the image
             */
            return asset($this->profile_image);
        } else {
            return "https://pixabay.com/fr/images/download/x-6380868_1920.png";
        }
    }
}
