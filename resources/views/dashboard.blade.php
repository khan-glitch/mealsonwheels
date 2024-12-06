<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

        <div id="map" style="height: 500px; width: 70%; padding: 50px;"></div>
        
        <!-- Element to display the current location name -->
        <div id="locationName" style="text-align: center; margin-top: 10px; font-size: 18px;"></div>

        <script>
        function initMap() {
        // Default location if geolocation fails
        var defaultLocation = { lat: -34.397, lng: 150.644 };

        // Create a map instance
        var map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 8
        });

        // Create a Geocoder instance
        var geocoder = new google.maps.Geocoder();

        // Try to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Center the map on the user's location
                map.setCenter(userLocation);

                // Add a marker at the user's location
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "You are here!"
                });

                // Reverse geocode to get the location name
                geocoder.geocode({ 'location': userLocation }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            // Set the address name under the map
                            document.getElementById('locationName').innerText = 'Current Location: ' + results[0].formatted_address;
                        } else {
                            document.getElementById('locationName').innerText = 'No address found for this location.';
                        }
                    } else {
                        document.getElementById('locationName').innerText = 'Geocoder failed due to: ' + status;
                    }
                });
            }, function() {
                handleLocationError(true, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
        }
    }

    // Handle geolocation errors
    function handleLocationError(browserHasGeolocation, pos) {
        alert(browserHasGeolocation
            ? 'Error: The Geolocation service failed.'
            : 'Error: Your browser doesn\'t support geolocation.');
    }

    // Initialize the map when the page loads
    window.onload = initMap;
</script>

</x-app-layout>
