<x-app-layout>
    <!-- Volunteer Dashboard -->
    <h1>Volunteer Dashboard</h1>
    <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>

    <div class="container">
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
                        <th>User Phone</th>
                        <th>Partner Name</th>
                        <th>Partner Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->meal->name ?? 'N/A' }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->pickup_location ?? 'N/A' }}</td>
                            <td>{{ $order->delivery_location ?? 'N/A' }}</td>
                            <td>{{ $order->user_phone ?? 'N/A' }}</td>
                            <td>{{ $order->partner->name ?? 'N/A' }}</td>
                            <td>{{ $order->partner_phone ?? 'N/A' }}</td>
                            <td>
                                @if ($order->status === 'Pending')
                                    <form action="{{ route('orders.accept', $order->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept Order</button>
                                    </form>
                                @elseif ($order->status === 'picking_up')
                                    <form action="{{ route('orders.deliverToPartner', $order->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Deliver to Partner</button>
                                    </form>
                                @elseif ($order->status === 'delivering')
                                    <form action="{{ route('orders.markDelivered', $order->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Mark as Delivered</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Order Delivered</button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <!-- Map for this order -->
                                <div id="map-{{ $order->id }}" style="width: 100%; height: 400px; margin-top: 10px;"></div>
                                <div class="actions" style="margin-top: 10px;">
                                    <button class="btn btn-primary" onclick="showPickupDirection({{ $order->id }}, '{{ $order->pickup_location }}')">Show Pickup Direction</button>
                                    <button class="btn btn-success" onclick="showDeliveryDirection({{ $order->id }}, '{{ $order->delivery_location }}')">Show Delivery Direction</button>
                                    <button class="btn btn-danger" onclick="clearMap({{ $order->id }})">Clear Map</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Add Google Maps API Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMaps" async defer></script>

    <script>
        const maps = {}; // Store map instances
        const directionsRenderers = {}; // Store DirectionsRenderer instances
        const directionsServices = {}; // Store DirectionsService instances

        // Initialize maps for all orders
        function initMaps() {
            @foreach ($orders as $order)
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            console.log(`User's Current Location: (${userLat}, ${userLng})`);

                            const map = new google.maps.Map(document.getElementById('map-{{ $order->id }}'), {
                                center: { lat: userLat, lng: userLng },
                                zoom: 14,
                            });

                            const userMarker = new google.maps.Marker({
                                position: { lat: userLat, lng: userLng },
                                map: map,
                                title: 'Your Current Location',
                            });

                            // Store map, DirectionsService, and DirectionsRenderer instances
                            maps[{{ $order->id }}] = map;
                            directionsServices[{{ $order->id }}] = new google.maps.DirectionsService();
                            directionsRenderers[{{ $order->id }}] = new google.maps.DirectionsRenderer({ map: map });
                        },
                        function (error) {
                            console.error('Error fetching geolocation: ', error);
                            alert('Failed to fetch geolocation. Please allow location access in your browser.');
                        }
                    );
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            @endforeach
        }

        // Show direction to the Pickup Location
        function showPickupDirection(orderId, pickupLocation) {
            const geocoder = new google.maps.Geocoder();
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLatLng = { lat: position.coords.latitude, lng: position.coords.longitude };

                geocoder.geocode({ address: pickupLocation }, function (results, status) {
                    if (status === 'OK') {
                        const destinationLatLng = results[0].geometry.location;
                        const request = {
                            origin: userLatLng,
                            destination: destinationLatLng,
                            travelMode: 'DRIVING',
                        };

                        directionsServices[orderId].route(request, function (response, status) {
                            if (status === 'OK') {
                                directionsRenderers[orderId].setDirections(response);
                            } else {
                                alert('Directions request failed: ' + status);
                            }
                        });
                    } else {
                        alert('Geocoding failed: ' + status);
                    }
                });
            });
        }

        // Show direction to the Delivery Location
        function showDeliveryDirection(orderId, deliveryLocation) {
            const geocoder = new google.maps.Geocoder();
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLatLng = { lat: position.coords.latitude, lng: position.coords.longitude };

                geocoder.geocode({ address: deliveryLocation }, function (results, status) {
                    if (status === 'OK') {
                        const destinationLatLng = results[0].geometry.location;
                        const request = {
                            origin: userLatLng,
                            destination: destinationLatLng,
                            travelMode: 'DRIVING',
                        };

                        directionsServices[orderId].route(request, function (response, status) {
                            if (status === 'OK') {
                                directionsRenderers[orderId].setDirections(response);
                            } else {
                                alert('Directions request failed: ' + status);
                            }
                        });
                    } else {
                        alert('Geocoding failed: ' + status);
                    }
                });
            });
        }

        // Clear map for another round
        function clearMap(orderId) {
            if (directionsRenderers[orderId]) {
                directionsRenderers[orderId].setDirections({ routes: [] }); // Clear directions
            }
            if (maps[orderId]) {
                maps[orderId].setZoom(14); // Reset zoom
                maps[orderId].setCenter({ lat: 13.736717, lng: 100.523186 }); // Example default center
            }
        }
    </script>

</x-app-layout>
