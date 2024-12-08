<x-app-layout>
    <div style="background: linear-gradient(135deg, #032E8A 0%, #0077BE 100%); min-height: 100vh; padding: 3rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="font-size: 3.5rem; font-weight: 800; text-align: center; margin-bottom: 2rem; color: #FFD700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">My Orders</h1>

            @if ($orders->isEmpty())
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 1rem; padding: 3rem; text-align: center; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                    <p style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #ffffff;">You have not placed any orders yet.</p>
                    <a href="{{ route('meals.index') }}" style="display: inline-block; background-color: #FFD700; color: #032E8A; padding: 0.75rem 2rem; border-radius: 2rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        Browse Meals
                    </a>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                    @foreach ($orders as $order)
                        <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 1rem; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 40px rgba(0, 0, 0, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)';">
                            <div style="position: relative; height: 200px; overflow: hidden;">
                                @if ($order->meal->image)
                                    <img src="{{ asset('storage/' . $order->meal->image) }}" alt="{{ $order->meal->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; background-color: #0077BE; display: flex; justify-content: center; align-items: center; color: #ffffff; font-size: 1.2rem;">No Image Available</div>
                                @endif
                                <div style="position: absolute; top: 10px; right: 10px; background-color: #FFD700; color: #032E8A; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: 600;">
                                    {{ $order->quantity }}
                                </div>
                            </div>
                            <div style="padding: 1.5rem;">
                                <h2 style="font-size: 1.5rem; font-weight: 700; color: #FFD700; margin-bottom: 1rem;">{{ $order->meal->name ?? 'N/A' }}</h2>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Status:</strong> 
                                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 1rem; font-weight: 600; 
                                        @if($order->status == 'Pending') background-color: #FFD700; color: #032E8A;
                                        @elseif($order->status == 'Delivered') background-color: #4CAF50; color: #ffffff;
                                        @else background-color: #3498db; color: #ffffff;
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Pickup:</strong> {{ $order->pickup_location ?? 'N/A' }}</p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Delivery:</strong> {{ $order->delivery_location ?? 'N/A' }}</p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Partner:</strong> {{ $order->partner->name ?? 'N/A' }}</p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>User Phone:</strong> {{ $order->user_phone ?? 'N/A' }}</p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Partner Phone:</strong> {{ $order->partner_phone ?? 'N/A' }}</p>
                                <p style="color: #ffffff; margin-bottom: 0.5rem;"><strong>Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
                                <p style="color: #ffffff; margin-bottom: 1rem;"><strong>Time:</strong> <span class="local-time" data-utc="{{ $order->created_at->toIso8601String() }}"></span></p>
                                
                                @if($order->status == 'Pending')
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width: 100%; background-color: #FF4136; color: #ffffff; padding: 0.75rem 1rem; border: none; border-radius: 2rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" onmouseover="this.style.backgroundColor='#E71D36'" onmouseout="this.style.backgroundColor='#FF4136'">
                                            Cancel Order
                                        </button>
                                    </form>
                                @else
                                    <p style="color: #a0aec0; text-align: center;">Order cannot be cancelled</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
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
    <footer style="background-color: #032E8A; color: #ffffff; padding: 2rem 0; text-align: center;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
                <p style="margin-bottom: 1rem;">&copy; 2024 Meals on Wheels. All rights reserved.</p>
                <div>
                    <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem; transition: color 0.3s ease;" onmouseover="this.style.color='#FFA500'" onmouseout="this.style.color='#FFD700'">About Us</a>
                    <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem; transition: color 0.3s ease;" onmouseover="this.style.color='#FFA500'" onmouseout="this.style.color='#FFD700'">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>

