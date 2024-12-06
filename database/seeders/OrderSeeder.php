<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'id' => 1,
            'user_id' => 1, // Assuming this references a valid user
            'details' => 'Meal delivery for City Center'
        ]);

        Order::create([
            'id' => 2,
            'user_id' => 2,
            'details' => 'Meal delivery for Downtown'
        ]);
    }
}
