<x-app-layout>
<div style="background-color: #032E8A; color: #ffffff; min-height: 100vh; padding: 2rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 2rem; color: #FFD700;">Partner Dashboard</h1>

        <!-- Success Messages -->
        @if(session('success'))
            <div style="background-color: #4CAF50; color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">{{ session('success') }}</div>
        @endif

        <!-- Add or Edit Meal Form -->
        <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; margin-bottom: 2rem;">
            <h2 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 1rem; color: #FFD700;">{{ isset($meal) ? 'Edit Meal' : 'Add Meal' }}</h2>
            <form action="{{ isset($meal) ? route('partner.meals.update', $meal->id) : route('partner.meals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($meal))
                    @method('PUT')
                @endif
                <div style="margin-bottom: 1rem;">
                    <label for="name" style="display: block; margin-bottom: 0.5rem;">Meal Name</label>
                    <input type="text" name="name" id="name" value="{{ $meal->name ?? '' }}" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="type" style="display: block; margin-bottom: 0.5rem;">Meal Type</label>
                    <select name="type" id="type" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                        <option value="hot" {{ (isset($meal) && $meal->type === 'hot') ? 'selected' : '' }}>Hot</option>
                        <option value="frozen" {{ (isset($meal) && $meal->type === 'frozen') ? 'selected' : '' }}>Frozen</option>
                    </select>
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="description" style="display: block; margin-bottom: 0.5rem;">Description</label>
                    <textarea name="description" id="description" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">{{ $meal->description ?? '' }}</textarea>
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="quantity" style="display: block; margin-bottom: 0.5rem;">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $meal->quantity ?? '' }}" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="available_from" style="display: block; margin-bottom: 0.5rem;">Available From</label>
                    <input type="datetime-local" name="available_from" id="available_from" value="{{ isset($meal) ? date('Y-m-d\TH:i', strtotime($meal->available_from)) : '' }}" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="available_until" style="display: block; margin-bottom: 0.5rem;">Available Until</label>
                    <input type="datetime-local" name="available_until" id="available_until" value="{{ isset($meal) ? date('Y-m-d\TH:i', strtotime($meal->available_until)) : '' }}" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="price" style="display: block; margin-bottom: 0.5rem;">Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ $meal->price ?? '' }}" required style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                </div>

                <!-- Image Upload Field -->
                <div style="margin-bottom: 1rem;">
                    <label for="image" style="display: block; margin-bottom: 0.5rem;">Meal Image</label>
                    <input type="file" name="image" id="image" style="width: 100%; padding: 0.5rem; border-radius: 0.25rem; border: none; background-color: rgba(255, 255, 255, 0.2); color: white;">
                    @if(isset($meal) && $meal->image)
                        <div style="margin-top: 0.5rem;">
                            <img src="{{ asset('storage/' . $meal->image) }}" alt="Meal Image" style="max-height: 150px; border-radius: 0.25rem;">
                        </div>
                    @endif
                </div>

                <button type="submit" style="background-color: #FF4500; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.25rem; cursor: pointer; font-weight: bold;">{{ isset($meal) ? 'Update Meal' : 'Add Meal' }}</button>
            </form>
        </div>

        <!-- List of Meals -->
        <h2 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 1rem; color: #FFD700;">Meals</h2>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem;">
                <thead>
                    <tr style="background-color: rgba(255, 255, 255, 0.2);">
                        <th style="padding: 1rem; text-align: left;">Image</th>
                        <th style="padding: 1rem; text-align: left;">Name</th>
                        <th style="padding: 1rem; text-align: left;">Type</th>
                        <th style="padding: 1rem; text-align: left;">Description</th>
                        <th style="padding: 1rem; text-align: left;">Quantity</th>
                        <th style="padding: 1rem; text-align: left;">Price</th>
                        <th style="padding: 1rem; text-align: left;">Available From</th>
                        <th style="padding: 1rem; text-align: left;">Available Until</th>
                        <th style="padding: 1rem; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                        <tr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                            <td style="padding: 1rem;">
                                @if($meal->image)
                                    <img src="{{ asset('storage/' . $meal->image) }}" alt="Meal Image" style="max-height: 50px; border-radius: 0.25rem;">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="padding: 1rem;">{{ $meal->name }}</td>
                            <td style="padding: 1rem;">{{ $meal->type }}</td>
                            <td style="padding: 1rem;">{{ $meal->description }}</td>
                            <td style="padding: 1rem;">{{ $meal->quantity }}</td>
                            <td style="padding: 1rem;">${{ $meal->price }}</td>
                            <td style="padding: 1rem;">{{ $meal->available_from }}</td>
                            <td style="padding: 1rem;">{{ $meal->available_until }}</td>
                            <td style="padding: 1rem;">
                                <a href="{{ route('partner.meals.edit', $meal->id) }}" style="background-color: #FFD700; color: #032E8A; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; display: inline-block; margin-bottom: 0.5rem;">Edit</a>
                                <form action="{{ route('partner.meals.destroy', $meal->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>

