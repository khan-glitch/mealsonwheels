<x-app-layout>
    <h1 style="text-align: center;">Volunteer Dashboard</h1>
    <p style="text-align: center;">Welcome, {{ Auth::user()->name }}!</p>

    <!-- Map Section -->
    <div id="map" style="height: 500px; width: 80%; margin: 20px auto; border: 2px solid #ddd; border-radius: 8px;"></div>
    <div id="locationName" style="text-align: center; margin-top: 10px; font-size: 18px;"></div>

    <!-- Delivery Quests Table -->
    <div class="container" style="margin: 30px auto; width: 90%;">
        <h2 style="text-align: center;">Available Delivery Quests</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Quest ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Pickup Location</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Drop-off Location</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deliveryQuests as $quest)
                    <tr id="quest-row-{{ $quest->id }}">
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $quest->id }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <a href="#" onclick="showRoute('{{ $quest->pickup_location }}')" style="text-decoration: underline; color: blue;">
                                {{ $quest->pickup_location }}
                            </a>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <a href="#" onclick="showRoute('{{ $quest->dropoff_location }}')" style="text-decoration: underline; color: blue;">
                                {{ $quest->dropoff_location }}
                            </a>
                        </td>
                        <td id="status-{{ $quest->id }}" style="padding: 10px; border: 1px solid #ddd;">
                            {{ ucfirst($quest->status) }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <button onclick="finishQuest({{ $quest->id }})" class="btn btn-success">Finish Quest</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; border: 1px solid #ddd; font-style: italic;">
                            No delivery quests available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Map Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>
    <script>
        let map, directionsService, directionsRenderer, userLocation;

        function initMap() {
            const defaultLocation = { lat: -34.397, lng: 150.644 };
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 10,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(userLocation);

                        new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "You are here!",
                            icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        });
                    },
                    function () {
                        alert("Geolocation failed. Please enable location services.");
                    }
                );
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        }

        window.onload = initMap;

        function showRoute(destination) {
            if (!userLocation) {
                alert("Unable to retrieve your current location.");
                return;
            }

            const request = {
                origin: userLocation,
                destination: destination,
                travelMode: 'DRIVING',
            };

            directionsService.route(request, function (result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                } else {
                    alert("Failed to load directions.");
                }
            });
        }

        function finishQuest(button) {
        const questId = button.getAttribute('data-quest-id');
        // Use questId for your logic

}   
    
    document.getElementById(`status-${questId}`).innerText = 'Delivered';

    function finishQuest(questId) {
    fetch(`/quests/${questId}/finish`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',  // Ensure CSRF protection
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            // Pass any data if needed
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Quest marked as delivered!');
            location.reload();  // Reload the page to reflect changes
        } else {
            alert('Failed to complete the quest: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while finishing the quest.');
    });
}


        
    </script>
</x-app-layout>
