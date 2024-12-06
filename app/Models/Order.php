<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Assuming the order is linked to a user
        // Add other fields as per your order requirements
    ];

    // Relationship with DeliveryQuest
    public function deliveryQuest()
    {
        return $this->hasOne(DeliveryQuest::class);
    }

    // Relationship with User (member/caregiver who ordered)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}