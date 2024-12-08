<x-app-layout>
    <h1>Admin Dashboard</h1>
    <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>All Orders</h2>

        @if ($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>User</th>
                        <th>Meal</th>
                        <th>Status</th>
                        <th>Pickup Location</th>
                        <th>Delivery Location</th>
                        <th>User Phone</th> <!-- Added User Phone Column -->
                        <th>Partner Name</th> <!-- Added Partner Name Column -->
                        <th>Partner Phone</th> <!-- Added Partner Phone Column -->
                        <th>Volunteer Name</th> <!-- Added Volunteer Name Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td> <!-- User's name -->
                            <td>{{ $order->meal->name ?? 'N/A' }}</td> <!-- Meal name -->
                            <td>{{ $order->status }}</td> <!-- Order status -->
                            <td>{{ $order->pickup_location ?? 'N/A' }}</td> <!-- Pickup location -->
                            <td>{{ $order->delivery_location ?? 'N/A' }}</td> <!-- Delivery location -->
                            <td>{{ $order->user_phone ?? 'N/A' }}</td> <!-- User phone -->
                            <td>{{ $order->partner->name ?? 'N/A' }}</td> <!-- Partner name -->
                            <td>{{ $order->partner_phone ?? 'N/A' }}</td> <!-- Partner phone -->
                            <td>{{ $order->volunteer->name ?? 'Unassigned' }}</td> <!-- Volunteer name -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
