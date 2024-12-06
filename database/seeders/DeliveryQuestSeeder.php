<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryQuest;

class DeliveryQuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are existing orders and users in the database
        // Replace 1 and 2 with actual IDs from your orders and users tables

        // Create Pending Quest
        DeliveryQuest::create([
            'order_id' => 1, // Existing order ID
            'volunteer_id' => null, // Not yet assigned
            'pickup_location' => '123 Main St, City Center',
            'delivery_location' => '456 Elm St, Suburbia',
            'status' => 'pending'
        ]);

        // Create Accepted Quest
        DeliveryQuest::create([
            'order_id' => 2, 
            'volunteer_id' => 1, // Assigned volunteer ID
            'pickup_location' => '789 Oak Ave, Downtown',
            'delivery_location' => '321 Maple Rd, Uptown',
            'status' => 'accepted'
        ]);

        // Create Completed Quest
        DeliveryQuest::create([
            'order_id' => 3,
            'volunteer_id' => 2,
            'pickup_location' => '555 Pine Ln, Riverside',
            'delivery_location' => '888 Birch Blvd, Midtown',
            'status' => 'delivered',
            'accepted_at' => now()->subDays(3),
            'picked_up_at' => now()->subDays(2),
            'delivered_at' => now()->subDay()
        ]);
    }
}
