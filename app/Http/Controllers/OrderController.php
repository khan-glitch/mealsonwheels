<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\User; // Import the User model to get partner details
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Check if the user is logged in and if they are a member or caregiver
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        $user = Auth::user();

        // Check user role
        if (!in_array($user->role, ['member', 'caregiver'])) {
            return redirect()->route('orders.index')->with('error', 'Only members and caregivers can place orders.');
        }

        // Validate the quantity input from the user
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $meal->quantity,
        ]);

        $quantity = $request->input('quantity');

        // Check if there’s enough quantity of the meal available
        if ($meal->quantity < $quantity) {
            return redirect()->route('orders.index')->with('error', 'Not enough quantity available.');
        }

        // Reduce the quantity of the meal
        $meal->quantity -= $quantity;
        $meal->save();

        // Create the order
        Order::create([
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'quantity' => $quantity,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }
}
