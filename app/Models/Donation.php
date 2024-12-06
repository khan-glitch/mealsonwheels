<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'donated_at', 'name']; // Include user_id in fillable

    protected $casts = [
        'donated_at' => 'datetime', // Cast donated_at as datetime
    ];
}