<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'location',
        'age',
        'disability',
        'role', // Ensure 'role' is used to differentiate between volunteers, members, etc.
        'password',
    ];

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
     * Relationship with orders (for members/caregivers who place orders).
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relationship with delivery quests (for volunteers who accept delivery tasks).
     */
    public function deliveryQuests()
    {
        return $this->hasMany(DeliveryQuest::class, 'volunteer_id');
    }
}