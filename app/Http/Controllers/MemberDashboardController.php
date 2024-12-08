<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import the Order model
use Illuminate\Support\Facades\Auth;



class MemberDashboardController extends Controller
{
    public function index()
    {
          // Retrieve orders where the user_id matches the authenticated user's ID
    // and the status is either 'pending', 'picking_up', or 'delivering'
    $orders = Order::where('user_id', Auth::id())
    ->whereIn('status', ['pending', 'picking_up', 'delivering'])
    ->get();

          return view('dashboards.member', compact('orders'));
    }
}
