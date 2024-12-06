<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index()
    {
        // Fetch donations ordered by latest
        $donations = Donation::orderBy('donated_at', 'desc')->get();
        return view('donor.index', compact('donations'));
    }

    public function showPaymentForm($method)
    {
        // Show payment form with the selected payment method
        return view('donor.payment', compact('method'));
    }

        public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        // Save the donation
        Donation::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'donated_at' => now(),
        ]);

        return redirect()->route('donor.index')->with('success', 'Donation made successfully!');
    }

    public function paymentSuccess()
    {
        // Success page after donation
        return view('donor.success');
    }

    public function paymentForm($method)
    {
        // Validate that the method is one of the allowed options
        $validMethods = ['visacard', 'mastercard', 'creditcard', 'bankingcard'];
        
        if (!in_array($method, $validMethods)) {
            abort(404); // If the payment method is invalid, show a 404 error
        }

        // Pass the selected payment method to the view
        return view('donor.payment', compact('method'));
    }
}
