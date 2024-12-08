<x-app-layout>
    <h1>Caregiver Dashboard</h1>
    <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>

    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <h2>Your Meal Orders</h2>

        @if ($orders->isEmpty())
            <p>You have no meal orders yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Meal</th>
                        <th>Status</th>
                        <th>Pickup Location</th>
                        <th>Delivery Location</th>
                        <th>Partner</th>
                        <th>User Phone</th> <!-- New column for User's phone -->
                        <th>Partner Phone</th> <!-- New column for Partner's phone -->
                        <th>Action</th> <!-- Add Action column for Cancel -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->meal->name ?? 'N/A' }}</td> <!-- Assuming a 'meal' relationship -->
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->pickup_location ?? 'N/A' }}</td>
                            <td>{{ $order->delivery_location ?? 'N/A' }}</td>
                            <td>{{ $order->partner->name ?? 'N/A' }}</td>
                            <td>{{ $order->user_phone ?? 'N/A' }}</td> <!-- User's phone number -->
                            <td>{{ $order->partner_phone ?? 'N/A' }}</td> <!-- Partner's phone number -->
                            <td>
                                <!-- Cancel Button Form -->
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #f44336; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem;">
                                        Cancel Order
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Success and Error Messages -->
    @if(session('success'))
        <div style="background-color: #4CAF50; color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div style="background-color: #F44336; color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif
</x-app-layout>
