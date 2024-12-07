<x-app-layout>
    <div class="container">
        <h1>Meals Available for Order</h1>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Hot Meals Section -->
        <h2>Hot Meals</h2>
        <div class="row">
            @foreach($hotMeals as $meal)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" alt="{{ $meal->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $meal->name }}</h5>
                            <p class="card-text">{{ $meal->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $meal->price }}</p>
                            <p class="card-text"><strong>Quantity Available:</strong> {{ $meal->quantity }}</p>

                            <!-- Partner Details -->
                            <p><strong>Partner:</strong> {{ $meal->partner->name }}</p>
                            <p><strong>Location:</strong> {{ $meal->partner->location }}</p>
                            <p><strong>Schedule:</strong> {{ $meal->partner->schedule }}</p>

                            <!-- Check if user is logged in and has correct role -->
                            @if(Auth::check())
                                @if(in_array(Auth::user()->role, ['member', 'caregiver']))
                                    <form action="{{ route('order.place', $meal->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $meal->quantity }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Order Now</button>
                                    </form>
                                @else
                                    <p class="text-danger">Only members and caregivers can place orders.</p>
                                @endif
                            @else
                                <p><a href="{{ route('login') }}" class="btn btn-primary">Login to Order</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Frozen Meals Section -->
        <h2>Frozen Meals</h2>
        <div class="row">
            @foreach($frozenMeals as $meal)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" alt="{{ $meal->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $meal->name }}</h5>
                            <p class="card-text">{{ $meal->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $meal->price }}</p>
                            <p class="card-text"><strong>Quantity Available:</strong> {{ $meal->quantity }}</p>

                            <!-- Partner Details -->
                            <p><strong>Partner:</strong> {{ $meal->partner->name }}</p>
                            <p><strong>Location:</strong> {{ $meal->partner->location }}</p>
                            <p><strong>Schedule:</strong> {{ $meal->partner->schedule }}</p>

                            <!-- Check if user is logged in and has correct role -->
                            @if(Auth::check())
                                @if(in_array(Auth::user()->role, ['member', 'caregiver']))
                                    <form action="{{ route('order.place', $meal->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $meal->quantity }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Order Now</button>
                                    </form>
                                @else
                                    <p class="text-danger">Only members and caregivers can place orders.</p>
                                @endif
                            @else
                                <p><a href="{{ route('login') }}" class="btn btn-primary">Login to Order</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
