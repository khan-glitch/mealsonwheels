<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\User; // Import the User model to get partner details
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Show the order page
    public function index()
    {
        // Get meals and group them into hot and frozen categories
        $hotMeals = Meal::where('type', 'hot')->get(); // Fetch hot meals
        $frozenMeals = Meal::where('type', 'frozen')->get(); // Fetch frozen meals

        // Get the partner details (users) associated with each meal
        foreach ($hotMeals as $meal) {
            $meal->partner = User::find($meal->partner_id); // Associate partner
        }

        foreach ($frozenMeals as $meal) {
            $meal->partner = User::find($meal->partner_id); // Associate partner
        }

        // Pass meals categorized into hot and frozen and the partners to the view
        return view('orders.index', compact('hotMeals', 'frozenMeals'));
    }

    // Process the order
    public function placeOrder(Request $request, Meal $meal)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        $user = Auth::user();

        // Validate if the logged-in user is a member or caregiver
        if (!in_array($user->role, ['member', 'caregiver'])) {
            return redirect()->route('orders.index')->with('error', 'Only members and caregivers can place orders.');
        }

        // Validate the quantity input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $meal->quantity,
        ]);

        $quantity = $request->input('quantity');

        // Check if the requested quantity is available
        if ($meal->quantity < $quantity) {
            return redirect()->route('orders.index')->with('error', 'Not enough quantity available.');
        }

        // Reduce the meal quantity
        $meal->quantity -= $quantity;
        $meal->save();

        // Get the user's phone number (make sure it's fetched properly)
        $userPhone = $user->phone_number; // Assuming 'phone_number' is the column name in users table
        Log::info('User Phone Number: ' . $userPhone); // Check the user phone value

        // Get the partner's phone number (ensure it's fetched correctly)
        $partnerPhone = User::where('id', $meal->partner_id)->value('phone_number'); // Get partner's phone number
        Log::info('Partner Phone Number: ' . $partnerPhone); // Check the partner phone value

        // Check if phone numbers are properly assigned before saving
        if (!$userPhone) {
            Log::warning('User phone number is missing or null.');
        }

        if (!$partnerPhone) {
            Log::warning('Partner phone number is missing or null.');
        }

        $partner = User::find($meal->partner_id);  // Get the partner (user) associated with this meal
        $pickup_location = $partner ? $partner->location : 'Unknown'; // Get the partner's location or set as 'Unknown'
    $delivery_location = $user->location;  // Using the user's own location for delivery

        // Create the order and save it with the phone numbers
        $order = Order::create([
            'user_id' => $user->id, // ID of the user placing the order
            'meal_id' => $meal->id, // ID of the meal being ordered
            'quantity' => $quantity, // Quantity of the meal ordered
            'partner_id' => $meal->partner_id, // Partner providing the meal
            'pickup_location' => $pickup_location,
            'delivery_location' => $delivery_location, // Delivery location from partner
            'user_phone' => $userPhone ?? 'N/A', // User's phone number (from the 'users' table)
            'partner_phone' => $partnerPhone ?? 'N/A', // Partner's phone number (from the 'users' table)
        ]);

        // Log the order creation
        Log::info('Order created with user phone: ' . $userPhone . ' and partner phone: ' . $partnerPhone);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }
    public function cancelOrder(Order $order)
    {
        // Check if the logged-in user is the one who placed the order
        if (Auth::id() !== $order->user_id) {
            return redirect()->route('orders.index')->with('error', 'You are not authorized to cancel this order.');
        }

        // Restore the meal quantity (if required) before deleting the order
        $meal = $order->meal;
        $meal->quantity += $order->quantity;
        $meal->save();

        // Delete the order
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order canceled successfully.');
    }


}
