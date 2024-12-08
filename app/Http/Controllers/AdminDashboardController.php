<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch all orders, including those from members and caregivers
        $orders = Order::whereIn('status', ['pending', 'picking_up', 'delivering'])->get();
        // Or you can add any additional filters if needed

        return view('dashboards.admin', compact('orders'));
    }
}

