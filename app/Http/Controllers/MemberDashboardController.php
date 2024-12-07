<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class MemberDashboardController extends Controller
{
    public function index()
    {
        // Fetch orders for the currently logged-in member
        $orders = Order::with('meal')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass orders to the member dashboard view
        return view('dashboards.member', compact('orders'));
    }
}
