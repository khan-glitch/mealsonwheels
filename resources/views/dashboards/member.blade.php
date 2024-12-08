<x-app-layout>
    <div class="bg-[#032E8A] text-white min-h-screen py-12" style="background-color: #032E8A;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center mb-12" style="color: #FFD700;">My Orders</h1> <!-- Gold heading -->

            @if ($orders->isEmpty())
                <p class="text-center text-xl">You have not placed any orders yet.</p>
            @else
                <div class="bg-white bg-opacity-10 shadow-xl rounded-lg overflow-hidden" style="background-color: rgba(255, 255, 255, 0.1);">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-[#FFD700] text-[#032E8A]">
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">Food</th>
                                    <th class="py-4 px-6 text-center text-lg font-semibold text-black-500">Image</th>
                                    <th class="py-4 px-6 text-center text-lg font-semibold text-black-500">Quantity</th>
                                    <th class="py-4 px-6 text-center text-lg font-semibold text-black-500">Date</th>
                                    <th class="py-4 px-6 text-center text-lg font-semibold text-black-500">Time (Local)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="border-b border-white border-opacity-20 hover:bg-blue-600 hover:bg-opacity-30 transition-colors duration-200">
                                        <td class="py-4 px-6 text-left">
                                            <span class="font-medium text-white">{{ $order->meal->name }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex justify-center">
                                                @if ($order->meal->image)
                                                    <img src="{{ asset('storage/' . $order->meal->image) }}" alt="{{ $order->meal->name }}" class="w-20 h-20 object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-110">
                                                @else
                                                    <span class="text-gray-300">No Image</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="inline-block bg-[#FFD700] text-[#032E8A] rounded-full px-3 py-1 text-sm font-semibold">
                                                {{ $order->quantity }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center text-white">{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td class="py-4 px-6 text-center text-white">
                                            <span class="local-time" data-utc="{{ $order->created_at->toIso8601String() }}"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Convert UTC time to local time
        document.querySelectorAll('.local-time').forEach(function (element) {
            const utcTime = element.getAttribute('data-utc');
            const localTime = new Date(utcTime).toLocaleString('en-US', {
                timeZone: 'Asia/Yangon', // Specify the desired time zone (Myanmar Time)
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
            });
            element.textContent = localTime;
        });
    </script>
   <!-- Footer Section -->
   <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
    <p>&copy; 2024 Meals on Wheels. All rights reserved.</p>
    <div>
        <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
        <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
    </div>
</footer>



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
