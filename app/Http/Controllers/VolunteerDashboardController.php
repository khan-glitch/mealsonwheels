<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class VolunteerDashboardController extends Controller
{
    public function index()
    {
        // Fetch orders with specific statuses that need to be managed by the volunteer
        $orders = Order::whereIn('status', ['pending', 'picking_up', 'delivering'])->get();

        return view('dashboards.volunteer', compact('orders'));
    }

    // Accept the order and change status to 'picking_up'
    public function acceptOrder($orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status === 'Pending') {
            $order->status = 'picking_up';
            $order->volunteer_id = auth()->user()->id; // Assign volunteer who accepts
            $order->save();

            return redirect()->back()->with('success', 'Order accepted, please pick up the meal.');
        }

        return redirect()->back()->with('error', 'Unable to accept the order.');
    }

    // Mark the order as 'delivering'
    public function deliverToPartner($orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status === 'picking_up') {
            $order->status = 'delivering';
            $order->save();

            return redirect()->back()->with('success', 'Meal is on the way to the partner location.');
        }

        return redirect()->back()->with('error', 'Unable to start delivery to the partner.');
    }

    // Mark order as 'delivered'
    public function markDelivered($orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status === 'delivering') {
            $order->status = 'delivered';
            $order->save();

            return redirect()->back()->with('success', 'Meal delivered successfully!');
        }

        return redirect()->back()->with('error', 'Unable to mark as delivered.');
    }
}
