<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PartnerDashboardController extends Controller
{
    public function index()
    {
        $meals = Meal::where('partner_id', Auth::id())->get(); // Get meals for the logged-in partner
        return view('dashboards.partner', compact('meals'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data including image
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:hot,frozen',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after:available_from',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('meals', 'public'); // Store the image
        }

        // Add the partner_id of the logged-in user
        $validated['partner_id'] = Auth::id();

        // Create the new meal with validated data
        Meal::create($validated);

        return redirect()->route('partner.dashboard')->with('success', 'Meal added successfully.');
    }

    public function edit(Meal $meal)
    {
        // Ensure the meal belongs to the logged-in partner
        if ($meal->partner_id !== Auth::id()) {
            return redirect()->route('partner.dashboard')->with('error', 'Unauthorized access.');
        }

        $meals = Meal::where('partner_id', Auth::id())->get();
        return view('dashboards.partner', compact('meals', 'meal'));
    }

    public function update(Request $request, Meal $meal)
    {
        // Ensure the meal belongs to the logged-in partner
        if ($meal->partner_id !== Auth::id()) {
            return redirect()->route('partner.dashboard')->with('error', 'Unauthorized access.');
        }

        // Validate the incoming request data including image
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:hot,frozen',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after:available_from',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);

        // If an image is uploaded, delete the old one and store the new image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($meal->image) {
                Storage::disk('public')->delete($meal->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('meals', 'public');
        }

        // Update the meal with validated data
        $meal->update($validated);

        return redirect()->route('partner.dashboard')->with('success', 'Meal updated successfully.');
    }

    public function destroy(Meal $meal)
    {
        // Ensure the meal belongs to the logged-in partner
        if ($meal->partner_id !== Auth::id()) {
            return redirect()->route('partner.dashboard')->with('error', 'Unauthorized access.');
        }

        // Delete the image if it exists
        if ($meal->image) {
            Storage::disk('public')->delete($meal->image);
        }

        // Delete the meal
        $meal->delete();

        return redirect()->route('partner.dashboard')->with('success', 'Meal deleted successfully.');
    }
}
