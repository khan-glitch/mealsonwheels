<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Auth;  // Ensure Auth facade is imported
use App\Models\DeliveryQuest;

class VolunteerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display the volunteer dashboard
    public function index()
    {
        // Fetch all the quests where the status is 'Pending' or 'In Progress'
        $deliveryQuests = DeliveryQuest::whereIn('status', ['Pending', 'In Progress'])->get();

        return view('dashboards.volunteer', compact('deliveryQuests'));
    }


    

    // Accept a delivery quest
    public function accept($id)
    {
        // Get the delivery quest by ID
        $quest = DeliveryQuest::findOrFail($id);
        
        // Ensure the quest is in 'Pending' status before accepting
        if ($quest->status === 'Pending') {
            $quest->status = 'In Progress';  // Update status to 'In Progress'
            $quest->volunteer_id = Auth::id(); // Assign the logged-in user's ID
            $quest->save();  // Save the updated quest
            
            return redirect()->route('volunteer.dashboard')->with('success', 'You have accepted the quest!');
        }
        
        return redirect()->route('volunteer.dashboard')->with('error', 'This quest cannot be accepted.');
    }

    // Mark the pickup as complete
    public function markPickup($id)
    {
        $quest = DeliveryQuest::findOrFail($id);
        
        // Ensure the quest is 'In Progress' before marking pickup
        if ($quest->status === 'In Progress') {
            $quest->status = 'Pickup Complete';  // Update status
            $quest->save();  // Save the updated status
            
            return redirect()->route('volunteer.dashboard')->with('success', 'Pickup marked as complete!');
        }

        return redirect()->route('volunteer.dashboard')->with('error', 'This quest cannot be marked for pickup.');
    }

    // Mark the delivery as complete
    public function markDelivery($id)
    {
        $quest = DeliveryQuest::findOrFail($id);

        // Ensure the quest is 'Pickup Complete' before marking delivery
        if ($quest->status === 'Pickup Complete') {
            $quest->status = 'Completed';  // Update status to 'Completed'
            $quest->save();  // Save the updated status
            
            return redirect()->route('volunteer.dashboard')->with('success', 'Delivery completed successfully!');
        }

        return redirect()->route('volunteer.dashboard')->with('error', 'This quest cannot be marked for delivery.');
    }
}


