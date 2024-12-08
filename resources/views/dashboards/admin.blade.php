@extends('layouts.dashboardSidebar')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Total Users Card -->
    <div class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 rounded-lg shadow-xl p-6 transition-all transform hover:scale-105 hover:shadow-2xl hover:opacity-90 cursor-pointer">
        <h2 class="text-xl font-bold text-white">Total Users</h2>
        <p class="text-4xl font-semibold mt-2 text-white">{{ $roleCounts->sum() }}</p>
    </div>

    <!-- Total Donations Card -->
    <div class="bg-gradient-to-r from-teal-400 via-green-500 to-blue-500 rounded-lg shadow-xl p-6 transition-all transform hover:scale-105 hover:shadow-2xl hover:opacity-90 cursor-pointer">
        <h2 class="text-xl font-bold text-white">Total Donations</h2>
        <p class="text-4xl font-semibold mt-2 text-white">${{ number_format($totalDonations, 2) }}</p>
    </div>
</div>

<!-- Roles Breakdown -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-lg font-bold mb-4">Users by Role</h2>
    <ul class="space-y-2">
        @foreach ($roleCounts as $role => $count)
            <li class="flex justify-between border-b pb-2">
                <span class="capitalize text-gray-800">{{ $role }}</span>
                <span class="text-gray-600">{{ $count }}</span>
            </li>
        @endforeach
    </ul>
</div>

<!-- Donation Chart -->
<div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Donations Over Time</h2>
    <canvas id="donationChart" class="w-full max-h-[300px]"></canvas>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Hardcoded data for the chart
        const donationData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // Months
            datasets: [{
                label: 'Donations Received ($)',
                data: [400, 750, 1200, 950, 1500, 1800, 2200], // Donation amounts
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light fill color
                borderColor: 'rgba(75, 192, 192, 1)', // Line color
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 255, 255, 1)', // Points
                pointBorderColor: 'rgba(75, 192, 192, 1)',
                pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                fill: true, // Fill under the line
                tension: 0.4, // Smooth curve
            }]
        };

        // Chart options for enhanced visuals
        const donationOptions = {
            responsive: true,
            animation: {
                duration: 1500, // Animation duration (in ms)
                easing: 'easeOutBounce', // Smooth easing effect
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#334155', // Text color
                        font: {
                            size: 14,
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#475569', // Y-axis text color
                        font: {
                            size: 12,
                        },
                    },
                    grid: {
                        color: 'rgba(203, 213, 225, 0.3)', // Gridline color
                    },
                    title: {
                        display: true,
                        text: 'Donation Amount ($)',
                        color: '#1e293b',
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                    }
                },
                x: {
                    ticks: {
                        color: '#475569', // X-axis text color
                        font: {
                            size: 12,
                        },
                    },
                    grid: {
                        display: false, // Remove vertical gridlines
                    },
                    title: {
                        display: true,
                        text: 'Months',
                        color: '#1e293b',
                        font: {
                            size: 14,
                            weight: 'bold',
                        },
                    }
                }
            },
        };

        // Render the donation chart
        const ctx = document.getElementById('donationChart').getContext('2d');
        const donationChart = new Chart(ctx, {
            type: 'line',
            data: donationData,
            options: donationOptions,
        });
    </script>
@endsection
