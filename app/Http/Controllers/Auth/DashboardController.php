<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function memberDashboard()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('dashboards.member', compact('orders'));
    }

    public function caregiverDashboard()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('dashboards.caregiver', compact('orders'));
    }

    public function volunteerDashboard()
    {
        $orders = Order::where('status', 'Pending')->orWhere('status', 'Picked Up')->get();
        return view('dashboards.volunteer', compact('orders'));
    }

    public function adminDashboard()
    {
        $orders = Order::all();
        return view('dashboards.admin', compact('orders'));
    }
}
