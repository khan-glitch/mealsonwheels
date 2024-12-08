<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function fetchOrder()
    {
        // Fetch all orders, including those from members and caregivers
        $orders = Order::whereIn('status', ['pending', 'picking_up', 'delivering'])->get();
        // Or you can add any additional filters if needed

        return view('dashboards.adminVolunteer', compact('orders'));
    }
    public function index()
    {
        // Count total users and group by roles
        $roleCounts = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        // Calculate total donations
        $totalDonations = Donation::sum('amount');

        // Prepare donation chart data
        $donationChart = [
            'labels' => Donation::selectRaw('DATE_FORMAT(donated_at, "%b %Y") as month')
                ->groupBy('month')
                ->pluck('month'),
            'values' => Donation::selectRaw('SUM(amount) as total')
                ->groupByRaw('DATE_FORMAT(donated_at, "%Y-%m")')
                ->pluck('total'),
        ];

        return view('dashboards.admin', [
            'roleCounts' => $roleCounts,
            'totalDonations' => $totalDonations,
            'donationChart' => $donationChart,
        ]);
    }
}

