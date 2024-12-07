<?php
// app/Models/Meal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'description', 'quantity', 'available_from', 'available_until', 'price', 'image', 'partner_id',
    ];

    protected $dates = [
        'available_from', 'available_until',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
