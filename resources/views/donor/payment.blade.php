<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Card Number Formatting (inserting spaces every 4 digits)
        function formatCardNumber(event) {
            let input = event.target.value.replace(/\D/g, ''); // Remove all non-numeric characters
            let formatted = input.replace(/(.{4})(?=.)/g, '$1 '); // Add space every 4 digits
            event.target.value = formatted;
        }

        // Expiry Date Formatting (MM/YY)
        function formatExpiryDate(event) {
            let input = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
            if (input.length >= 3) {
                input = input.slice(0, 2) + '/' + input.slice(2, 4); // Format MM/YY
            }
            event.target.value = input;
        }

        // CVV Formatting (3 digits)
        function formatCVV(event) {
            let input = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
            event.target.value = input.slice(0, 3); // Limit to 3 digits
        }
    </script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-sans">

    <div class="container mx-auto p-8">
        <div class="max-w-lg mx-auto bg-white p-8 shadow-2xl rounded-lg mt-16 animate__animated animate__fadeIn">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Payment Form - {{ ucfirst($method) }}</h2>

            <form action="{{ route('donor.store') }}" method="POST">
                @csrf
                <input type="hidden" name="method" value="{{ $method }}">

                <!-- Donor Name Input -->
                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium text-gray-700">Your Name:</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="w-full mt-2 p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-shadow duration-200" 
                        placeholder="Enter your name"
                        required>
                </div>

                <!-- Donation Amount Input -->
                <div class="mb-6">
                    <label for="amount" class="block text-lg font-medium text-gray-700">Donation Amount:</label>
                    <input 
                        type="number" 
                        name="amount" 
                        id="amount" 
                        class="w-full mt-2 p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-shadow duration-200" 
                        placeholder="Enter donation amount"
                        min="1" 
                        required>
                </div>

                <!-- Card Number Input -->
                <div class="mb-6">
                    <label for="card_number" class="block text-lg font-medium text-gray-700">Card Number:</label>
                    <input 
                        type="text" 
                        name="card_number" 
                        id="card_number" 
                        placeholder="XXXX XXXX XXXX XXXX"
                        class="w-full mt-2 p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-shadow duration-200" 
                        maxlength="19" 
                        oninput="formatCardNumber(event)" 
                        required>
                </div>

                <!-- Expiry Date and CVV -->
                <div class="flex space-x-4 mb-6">
                    <div class="flex-1">
                        <label for="expiry_date" class="block text-lg font-medium text-gray-700">Expiry Date:</label>
                        <input 
                            type="text" 
                            name="expiry_date" 
                            id="expiry_date" 
                            placeholder="MM/YY"
                            class="w-full mt-2 p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-shadow duration-200" 
                            maxlength="5" 
                            oninput="formatExpiryDate(event)" 
                            required>
                    </div>

                    <div class="flex-1">
                        <label for="cvv" class="block text-lg font-medium text-gray-700">CVV:</label>
                        <input 
                            type="text" 
                            name="cvv" 
                            id="cvv" 
                            placeholder="XXX"
                            class="w-full mt-2 p-4 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-shadow duration-200" 
                            maxlength="3" 
                            oninput="formatCVV(event)" 
                            required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white py-4 rounded-lg font-semibold shadow-xl hover:bg-gradient-to-l hover:from-pink-500 hover:to-purple-600 transition duration-300 transform hover:scale-105">
                    Submit Payment
                </button>
            </form>
        </div>
    </div>

</body>
</html>
