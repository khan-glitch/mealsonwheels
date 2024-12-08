<x-app-layout>
    <div style="background-color: #032E8A; color: #ffffff; min-height: 100vh; padding: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <h1 style="font-size: 2.5rem; font-weight: bold; text-align: center; margin-bottom: 2rem; color: #FFD700;">
                Volunteer Dashboard
            </h1>
            <p style="font-size: 1.25rem; text-align: center; margin-bottom: 2rem;">Welcome to your dashboard, {{ Auth::user()->name }}!</p>

            <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; color: #FFD700;">All Orders</h2>

                @if ($orders->isEmpty())
                    <p style="text-align: center;">No orders found.</p>
                @else
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                            <thead>
                                <tr style="background-color: rgba(255, 255, 255, 0.2);">
                                    <th style="padding: 0.75rem; text-align: left;">Order Number</th>
                                    <th style="padding: 0.75rem; text-align: left;">User</th>
                                    <th style="padding: 0.75rem; text-align: left;">Meal</th>
                                    <th style="padding: 0.75rem; text-align: left;">Status</th>
                                    <th style="padding: 0.75rem; text-align: left;">Pickup Location</th>
                                    <th style="padding: 0.75rem; text-align: left;">Delivery Location</th>
                                    <th style="padding: 0.75rem; text-align: left;">User Phone</th>
                                    <th style="padding: 0.75rem; text-align: left;">Partner Name</th>
                                    <th style="padding: 0.75rem; text-align: left;">Partner Phone</th>
                                    <th style="padding: 0.75rem; text-align: left;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                        <td style="padding: 0.75rem;">{{ $order->id }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->user->name ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->meal->name ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->status }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->pickup_location ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->delivery_location ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->user_phone ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->partner->name ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">{{ $order->partner_phone ?? 'N/A' }}</td>
                                        <td style="padding: 0.75rem;">
                                            @if ($order->status === 'Pending')
                                                <form action="{{ route('orders.accept', $order->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer;">
                                                        Accept Order
                                                    </button>
                                                </form>
                                            @elseif ($order->status === 'picking_up')
                                                <form action="{{ route('orders.deliverToPartner', $order->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer;">
                                                        Deliver to Partner
                                                    </button>
                                                </form>
                                            @elseif ($order->status === 'delivering')
                                                <form action="{{ route('orders.markDelivered', $order->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer;">
                                                        Mark as Delivered
                                                    </button>
                                                </form>
                                            @else
                                                <button style="background-color: #808080; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; opacity: 0.5; cursor: not-allowed;" disabled>
                                                    Order Delivered
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="10" style="padding: 0.75rem;">
                                            <div id="map-{{ $order->id }}" style="width: 100%; height: 400px; margin-top: 1rem;"></div>
                                            <div style="margin-top: 1rem;">
                                                <button onclick="showPickupDirection({{ $order->id }}, '{{ $order->pickup_location }}')" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer; margin-right: 0.5rem;">
                                                    Show Pickup Direction
                                                </button>
                                                <button onclick="showDeliveryDirection({{ $order->id }}, '{{ $order->delivery_location }}')" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer; margin-right: 0.5rem;">
                                                    Show Delivery Direction
                                                </button>
                                                <button onclick="clearMap({{ $order->id }})" style="background-color: #FF4500; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; cursor: pointer;">
                                                    Clear Map
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
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
    <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
    <p>&copy; 2024 Meals on Wheels. All rights reserved.</p>
    <div>
        <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
        <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
    </div>
</footer>
</x-app-layout>