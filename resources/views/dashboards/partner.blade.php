<x-app-layout>
<div class="container">
    <h1>Partner Dashboard</h1>

    <!-- Success Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add or Edit Meal Form -->
    <h2>{{ isset($meal) ? 'Edit Meal' : 'Add Meal' }}</h2>
    <form action="{{ isset($meal) ? route('partner.meals.update', $meal->id) : route('partner.meals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($meal))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Meal Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $meal->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="type">Meal Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="hot" {{ (isset($meal) && $meal->type === 'hot') ? 'selected' : '' }}>Hot</option>
                <option value="frozen" {{ (isset($meal) && $meal->type === 'frozen') ? 'selected' : '' }}>Frozen</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $meal->description ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $meal->quantity ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="available_from">Available From</label>
            <input type="datetime-local" name="available_from" id="available_from" class="form-control" value="{{ isset($meal) ? date('Y-m-d\TH:i', strtotime($meal->available_from)) : '' }}" required>
        </div>
        <div class="form-group">
            <label for="available_until">Available Until</label>
            <input type="datetime-local" name="available_until" id="available_until" class="form-control" value="{{ isset($meal) ? date('Y-m-d\TH:i', strtotime($meal->available_until)) : '' }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $meal->price ?? '' }}" required>
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image">Meal Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if(isset($meal) && $meal->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $meal->image) }}" alt="Meal Image" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">{{ isset($meal) ? 'Update Meal' : 'Add Meal' }}</button>
    </form>

    <!-- List of Meals -->
    <h2 class="mt-5">Meals</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Available From</th>
                <th>Available Until</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td>
                        @if($meal->image)
                            <img src="{{ asset('storage/' . $meal->image) }}" alt="Meal Image" class="img-thumbnail" style="max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $meal->name }}</td>
                    <td>{{ $meal->type }}</td>
                    <td>{{ $meal->description }}</td>
                    <td>{{ $meal->quantity }}</td>
                    <td>${{ $meal->price }}</td>
                    <td>{{ $meal->available_from }}</td>
                    <td>{{ $meal->available_until }}</td>
                    <td>
                        <a href="{{ route('partner.meals.edit', $meal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('partner.meals.destroy', $meal->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-app-layout>
