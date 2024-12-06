<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-sans">

    <div class="container mx-auto p-6">
        <!-- Back Button -->
        <div class="mb-4">
        <a href="/" 
        class="flex items-center justify-center text-white bg-gradient-to-r from-teal-400 to-blue-500 py-1 px-2 w-24 rounded shadow-md hover:bg-gradient-to-l hover:from-blue-500 hover:to-teal-400 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.707-7.707a1 1 0 010-1.414L9.586 8H5a1 1 0 110-2h6a1 1 0 011 1v6a1 1 0 11-2 0V9.586l-1.293 1.293a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            Back
        </a>
       </div>



        <h1 class="text-4xl font-bold text-center mb-12 animate__animated animate__fadeIn animate__delay-1s">Donor Page</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-center mb-10">
            <button 
                onclick="openModal()" 
                class="bg-gradient-to-r from-teal-400 to-blue-500 text-white py-3 px-8 rounded-lg shadow-xl hover:bg-gradient-to-l hover:from-blue-500 hover:to-teal-400 transition duration-300 transform hover:scale-105">
                Donate Now
            </button>
        </div>

        <h2 class="text-3xl font-semibold mb-6 text-center">Donation List</h2>
        <div class="overflow-x-auto bg-white shadow-2xl rounded-lg p-4">
            <table class="min-w-full table-auto text-gray-800">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Donor Name</th>
                        <th class="px-6 py-4 text-left">Amount</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                        <tr class="hover:bg-gradient-to-r from-indigo-100 to-purple-100 transition duration-300 ease-in-out">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $donation->name }}</td>
                            <td class="px-6 py-4 text-green-600 font-bold">${{ number_format($donation->amount, 2) }}</td>
                            <td class="px-6 py-4">{{ $donation->donated_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">{{ $donation->donated_at->format('H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No donations yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="donateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white w-96 p-6 rounded-lg shadow-2xl transform transition duration-300 ease-in-out">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Choose Payment Method</h2>
            <ul>
                <li><a href="{{ route('donor.payment', ['method' => 'visacard']) }}" class="block py-2 px-4 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-lg mb-2 hover:from-blue-500 hover:to-green-400 transition transform hover:scale-105">Visa Card</a></li>
                <li><a href="{{ route('donor.payment', ['method' => 'mastercard']) }}" class="block py-2 px-4 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-lg mb-2 hover:from-blue-500 hover:to-green-400 transition transform hover:scale-105">MasterCard</a></li>
                <li><a href="{{ route('donor.payment', ['method' => 'creditcard']) }}" class="block py-2 px-4 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-lg mb-2 hover:from-blue-500 hover:to-green-400 transition transform hover:scale-105">Credit Card</a></li>
                <li><a href="{{ route('donor.payment', ['method' => 'bankingcard']) }}" class="block py-2 px-4 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-lg hover:from-blue-500 hover:to-green-400 transition transform hover:scale-105">Banking Card</a></li>
            </ul>
            <button onclick="closeModal()" class="mt-4 w-full bg-gray-500 text-white py-2 rounded-lg">Cancel</button>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('donateModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('donateModal').classList.add('hidden');
        }
    </script>

</body>
</html>
