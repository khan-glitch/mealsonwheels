@extends('layouts.dashboardSidebar')

@section('content')
    <div class="p-6 bg-white shadow-lg rounded-lg">

        <!-- Orders Section -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">All Orders</h2>

            @if ($orders->isEmpty())
                <p class="text-gray-600">No orders found.</p>
            @else
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Order Number</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">User</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Meal</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Pickup Location</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Delivery Location</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">User Phone</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Partner Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Partner Phone</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Volunteer Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->meal->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->status }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->pickup_location ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->delivery_location ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->user_phone ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->partner->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->partner_phone ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->volunteer->name ?? 'Unassigned' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
