@extends('layouts.navigation')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">My Orders</h1>

    @if ($orders->isEmpty())
        <p class="text-center text-xl text-gray-600">You have not placed any orders yet.</p>
    @else
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-lg">Food</th>
                        <th class="py-3 px-4 text-left text-lg">Image</th>
                        <th class="py-3 px-4 text-left text-lg">Quantity</th>
                        <th class="py-3 px-4 text-left text-lg">Date</th>
                        <th class="py-3 px-4 text-left text-lg">Time (Local)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="table-row hover:bg-indigo-50 transition-all duration-300">
                            <td class="py-4 px-6 text-gray-800">{{ $order->meal->name }}</td>
                            <td class="py-4 px-6 text-center">
                                @if ($order->meal->image)
                                    <img src="{{ asset('storage/' . $order->meal->image) }}" alt="{{ $order->meal->name }}" class="hover-img rounded-lg w-16 h-16 object-cover mx-auto">
                                @else
                                    <span class="text-gray-400">No Image Available</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-800">{{ $order->quantity }}</td>
                            <td class="py-4 px-6 text-gray-800">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="py-4 px-6 text-gray-800">
                                <!-- Pass the UTC time to JS -->
                                <span class="local-time" data-utc="{{ $order->created_at->toIso8601String() }}"></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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

@endsection
