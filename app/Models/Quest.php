<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $table = 'quests'; // Replace 'quests' with your table name if different
    protected $fillable = ['status']; // Add all fillable fields here
}

