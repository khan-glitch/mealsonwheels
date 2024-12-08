<x-app-layout>
    <div style="background-color: #032E8A; color: #ffffff; min-height: 100vh; padding: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <h1 style="font-size: 2.5rem; font-weight: bold; text-align: center; margin-bottom: 2rem; color: #FFD700;">
                Delicious Meals Await
            </h1>

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

            <div style="display: flex; justify-content: center; margin-bottom: 2rem;">
                <button onclick="showTab('hot')" style="padding: 0.75rem 1.5rem; background-color: #FF4500; color: white; border: none; border-radius: 0.25rem 0 0 0.25rem; cursor: pointer;">
                    Hot Meals
                </button>
                <button onclick="showTab('frozen')" style="padding: 0.75rem 1.5rem; background-color: #1E90FF; color: white; border: none; border-radius: 0 0.25rem 0.25rem 0; cursor: pointer;">
                    Frozen Meals
                </button>
            </div>

            <!-- Hot Meals Section -->
            <div id="hotMeals" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                @foreach($hotMeals as $meal)
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1rem;">
                        <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem;">{{ $meal->name }}</h3>
                        <p style="color: #D3D3D3; margin-bottom: 1rem;">{{ $meal->description }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: #FFD700;">${{ $meal->price }}</span>
                            <span style="background-color: #4CAF50; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem;">{{ $meal->quantity }} left</span>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <h4 style="font-weight: bold; margin-bottom: 0.5rem;">Partner Info:</h4>
                            <p>{{ $meal->partner->name }}</p>
                            <p>{{ $meal->partner->location }}</p>
                            <p>{{ $meal->partner->schedule }}</p>
                        </div>
                        <form action="{{ route('order.place', $meal->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem; background-color: rgba(255, 255, 255, 0.2); color: white; border: none; border-radius: 0.25rem;" value="1" min="1" max="{{ $meal->quantity }}" required>
                            <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #FF4500; color: white; border: none; border-radius: 0.25rem; cursor: pointer;">
                                Order Now
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Frozen Meals Section -->
            <div id="frozenMeals" style="display: none; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                @foreach($frozenMeals as $meal)
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1rem;">
                        <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem;">{{ $meal->name }}</h3>
                        <p style="color: #D3D3D3; margin-bottom: 1rem;">{{ $meal->description }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: #FFD700;">${{ $meal->price }}</span>
                            <span style="background-color: #4CAF50; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem;">{{ $meal->quantity }} left</span>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <h4 style="font-weight: bold; margin-bottom: 0.5rem;">Partner Info:</h4>
                            <p>{{ $meal->partner->name }}</p>
                            <p>{{ $meal->partner->location }}</p>
                            <p>{{ $meal->partner->schedule }}</p>
                        </div>
                        <form action="{{ route('order.place', $meal->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" style="width: 100%; padding: 0.5rem; margin-bottom: 0.5rem; background-color: rgba(255, 255, 255, 0.2); color: white; border: none; border-radius: 0.25rem;" value="1" min="1" max="{{ $meal->quantity }}" required>
                            <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #1E90FF; color: white; border: none; border-radius: 0.25rem; cursor: pointer;">
                                Order Now
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            const hotMeals = document.getElementById('hotMeals');
            const frozenMeals = document.getElementById('frozenMeals');
            const buttons = document.querySelectorAll('button');

            if (tabName === 'hot') {
                hotMeals.style.display = 'grid';
                frozenMeals.style.display = 'none';
                buttons[0].style.backgroundColor = '#FF4500';
                buttons[1].style.backgroundColor = '#1E90FF';
            } else {
                hotMeals.style.display = 'none';
                frozenMeals.style.display = 'grid';
                buttons[0].style.backgroundColor = '#1E90FF';
                buttons[1].style.backgroundColor = '#FF4500';
            }
        }
    </script>
    <!-- Footer Section -->
    <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
    <p>&copy; 2024 Meals on Wheels. All rights reserved.</p>
    <div>
        <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
        <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
    </div>
</footer>
</x-app-layout>

