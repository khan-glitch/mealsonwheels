    <x-app-layout>
        <div class="bg-[#032E8A] text-white min-h-screen py-12" style="background-color: #032E8A;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold text-center mb-12" style="color: #FFD700;">Donor Page</h1> <!-- Gold heading -->

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Donation List --}}
                <div class="bg-white bg-opacity-10 shadow-xl rounded-lg overflow-hidden" style="background-color: rgba(255, 255, 255, 0.1);">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-[#FFD700] text-[#032E8A]">
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">#</th>
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">Donor Name</th>
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">Amount</th>
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">Date</th>
                                    <th class="py-4 px-6 text-left text-lg font-semibold text-black-500">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $donation)
                                    <tr class="border-b border-white border-opacity-20 hover:bg-blue-600 hover:bg-opacity-30 transition-colors duration-200">
                                        <td class="py-4 px-6 text-white">{{ $loop->iteration }}</td>
                                        <td class="py-4 px-6 text-white">{{ $donation->name }}</td>
                                        <td class="py-4 px-6 text-green-400 font-bold">${{ number_format($donation->amount, 2) }}</td>
                                        <td class="py-4 px-6 text-white">{{ $donation->donated_at->format('Y-m-d') }}</td>
                                        <td class="py-4 px-6 text-white">
                                            <span class="local-time" data-utc="{{ $donation->donated_at->toIso8601String() }}"></span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-center text-white">No donations yet!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Donate Button --}}
                <div class="text-center mt-8">
                    <button 
                        onclick="openModal()" 
                        class="bg-[#FFD700] text-[#032E8A] py-3 px-8 rounded-lg shadow-md hover:bg-opacity-80 transition duration-300">
                        Donate Now
                    </button>
                </div>

                {{-- Donate Modal --}}
                <div id="donateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold mb-4 text-[#032E8A]">Choose Payment Method</h2>
                        <ul>
                            <li><a href="{{ route('donor.payment', ['method' => 'visacard']) }}" class="block py-2 px-4 bg-[#FFD700] text-[#032E8A] rounded-lg mb-2 hover:bg-opacity-80 transition">Visa Card</a></li>
                            <li><a href="{{ route('donor.payment', ['method' => 'mastercard']) }}" class="block py-2 px-4 bg-[#FFD700] text-[#032E8A] rounded-lg mb-2 hover:bg-opacity-80 transition">MasterCard</a></li>
                            <li><a href="{{ route('donor.payment', ['method' => 'creditcard']) }}" class="block py-2 px-4 bg-[#FFD700] text-[#032E8A] rounded-lg mb-2 hover:bg-opacity-80 transition">Credit Card</a></li>
                            <li><a href="{{ route('donor.payment', ['method' => 'bankingcard']) }}" class="block py-2 px-4 bg-[#FFD700] text-[#032E8A] rounded-lg hover:bg-opacity-80 transition">Banking Card</a></li>
                        </ul>
                        <button onclick="closeModal()" class="mt-4 w-full bg-gray-500 text-white py-2 rounded-lg">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                document.getElementById('donateModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('donateModal').classList.add('hidden');
            }

            // Convert UTC time to local time
            document.querySelectorAll('.local-time').forEach(function (element) {
                const utcTime = element.getAttribute('data-utc');
                const localTime = new Date(utcTime).toLocaleString('en-US', {
                    timeZone: 'Asia/Yangon', // Specify the desired time zone (Myanmar Time)
                    hour12: true,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                element.textContent = localTime;
            });
        </script>

        <!-- Footer Section -->
        <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
            <p>&copy; 2024 Your Organization. All rights reserved.</p>
            <div>
                <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
                <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
            </div>
        </footer>
    </x-app-layout>
