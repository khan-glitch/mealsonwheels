<?php
// App\Models\Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meal_id', 'quantity', 'status', 'partner_id', 'volunteer_id', 'pickup_location', 'delivery_location' ,'user_phone',
    'partner_phone',];

    use HasFactory;

    // Relationship with User (Member)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Caregiver
    public function caregiver()
    {
        return $this->belongsTo(User::class, 'caregiver_id');
    }

    // Relationship with Meal
    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }
    public function partner()
{
    return $this->belongsTo(User::class, 'partner_id'); // Assuming partner_id is the foreign key in the orders table
}
// In Order.php (Model)
public function volunteer()
{
    return $this->belongsTo(User::class, 'volunteer_id');
}

}
