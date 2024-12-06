<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller; 
use App\Models\DeliveryQuest;
use Illuminate\Support\Facades\Auth;
use App\Models\Quest;
use Illuminate\Http\Request;

class DeliveryQuestController extends Controller
{
    // Constructor to ensure the user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateToDelivering($id) {
        $quest = DeliveryQuest::findOrFail($id);

        if ($quest->status === 'Pending') {
            $quest->status = 'Delivering';
            $quest->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Quest cannot be updated to Delivering.']);
    }

    // Accept a delivery quest
    public function accept($id)
    {
        // Find the delivery quest by ID
        $quest = DeliveryQuest::findOrFail($id);

        // Check if the quest is pending
        if ($quest->status === 'Pending') {
            // Update the quest status and assign the volunteer
            $quest->status = 'In Progress';
            $quest->volunteer_id = Auth::id();
            $quest->save();

            return response()->json(['message' => 'Quest accepted successfully!']);
        }

        return response()->json(['message' => 'This quest cannot be accepted.'], 400);
    }

    // Mark the pickup as complete
    public function markPickup($id)
    {
        // Find the delivery quest by ID
        $quest = DeliveryQuest::findOrFail($id);

        // Ensure the quest status is 'In Progress' before marking pickup
        if ($quest->status === 'In Progress') {
            $quest->status = 'Pickup Complete'; // Change status to Pickup Complete
            $quest->save();

            return response()->json(['message' => 'Pickup marked as complete!']);
        }

        return response()->json(['message' => 'This quest cannot be marked for pickup.'], 400);
    }

    public function finish($id) {
        $quest = DeliveryQuest::findOrFail($id);
    
        if ($quest->status !== 'Completed') {
            $quest->status = 'Delivered';
            $quest->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Quest already completed.']);
    }

    // Mark the delivery as complete
    public function markDelivery($id)
    {
        // Find the delivery quest by ID
        $quest = DeliveryQuest::findOrFail($id);

        // Ensure the quest status is 'Pickup Complete' before marking delivery
        if ($quest->status === 'Pickup Complete') {
            $quest->status = 'Completed'; // Mark quest as completed
            $quest->save();

            return response()->json(['message' => 'Delivery completed successfully!']);
        }

        return response()->json(['message' => 'This quest cannot be marked for delivery.'], 400);
    }
}
