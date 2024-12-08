@extends('layouts.dashboardSidebar')

@section('content')
    <!-- Donation Content -->
    <div class="container mx-auto p-6">

        <!-- Total Donations Card -->
        <div class="bg-gradient-to-r from-teal-400 via-green-500 to-blue-500 rounded-lg shadow-xl p-6 mb-6">
            <h2 class="text-2xl font-bold text-white">Total Donations</h2>
            <p class="text-4xl font-semibold mt-2 text-white">${{ number_format($totalDonations, 2) }}</p>
        </div>

        <!-- Donations Table -->
        <div class="bg-white rounded-lg shadow-lg p-6 overflow-x-auto">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Recent Donations</h2>
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-gray-700">Donor Name</th>
                        <th class="py-2 px-4 border-b text-left text-gray-700">Amount</th>
                        <th class="py-2 px-4 border-b text-left text-gray-700">Donation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="py-2 px-4 border-b text-gray-700">{{ $donation->name }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">${{ number_format($donation->amount, 2) }}</td>
                            <td class="py-2 px-4 border-b text-gray-700">{{ $donation->donated_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
