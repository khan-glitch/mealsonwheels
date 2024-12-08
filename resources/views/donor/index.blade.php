<x-app-layout>
    <div style="background: linear-gradient(135deg, #032E8A 0%, #0077BE 100%); min-height: 100vh; padding: 3rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="font-size: 3.5rem; font-weight: 800; text-align: center; margin-bottom: 2rem; color: #FFD700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Donor Page</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div style="background-color: rgba(52, 211, 153, 0.1); color: #34D399; padding: 1rem; border-radius: 0.5rem; backdrop-filter: blur(10px); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 2rem; text-align: center; font-weight: 600;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Donation List --}}
            <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 1rem; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr style="background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);">
                                <th style="padding: 1rem; text-align: left; color: #032E8A; font-size: 1rem; font-weight: 600;">#</th>
                                <th style="padding: 1rem; text-align: left; color: #032E8A; font-size: 1rem; font-weight: 600;">Donor Name</th>
                                <th style="padding: 1rem; text-align: left; color: #032E8A; font-size: 1rem; font-weight: 600;">Amount</th>
                                <th style="padding: 1rem; text-align: left; color: #032E8A; font-size: 1rem; font-weight: 600;">Date</th>
                                <th style="padding: 1rem; text-align: left; color: #032E8A; font-size: 1rem; font-weight: 600;">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); transition: background-color 0.3s ease;">
                                    <td style="padding: 1rem; color: #ffffff;">{{ $loop->iteration }}</td>
                                    <td style="padding: 1rem; color: #ffffff;">{{ $donation->name }}</td>
                                    <td style="padding: 1rem; color: #4ADE80; font-weight: 700;">${{ number_format($donation->amount, 2) }}</td>
                                    <td style="padding: 1rem; color: #ffffff;">{{ $donation->donated_at->format('Y-m-d') }}</td>
                                    <td style="padding: 1rem; color: #ffffff;">
                                        <span class="local-time" data-utc="{{ $donation->donated_at->toIso8601String() }}"></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 2rem; text-align: center; color: #ffffff;">No donations yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Donate Button --}}
            <div style="text-align: center; margin-top: 3rem;">
                <button 
                    onclick="openModal()" 
                    style="background-color: #FFD700; color: #032E8A; padding: 1rem 2rem; font-size: 1.2rem; font-weight: 600; border: none; border-radius: 2rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                    onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 8px rgba(0, 0, 0, 0.15)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
                    Donate Now
                </button>
            </div>

            {{-- Donate Modal --}}
            <div id="donateModal" style="display: none; position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
                <div style="background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%); width: 24rem; padding: 2rem; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);">
                    <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #032E8A; text-align: center;">Choose Payment Method</h2>
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('donor.payment', ['method' => 'visacard']) }}" style="display: block; padding: 0.75rem 1rem; background-color: #FFD700; color: #032E8A; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#FFC000';" onmouseout="this.style.backgroundColor='#FFD700';">Visa Card</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('donor.payment', ['method' => 'mastercard']) }}" style="display: block; padding: 0.75rem 1rem; background-color: #FFD700; color: #032E8A; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#FFC000';" onmouseout="this.style.backgroundColor='#FFD700';">MasterCard</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('donor.payment', ['method' => 'creditcard']) }}" style="display: block; padding: 0.75rem 1rem; background-color: #FFD700; color: #032E8A; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#FFC000';" onmouseout="this.style.backgroundColor='#FFD700';">Credit Card</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="{{ route('donor.payment', ['method' => 'bankingcard']) }}" style="display: block; padding: 0.75rem 1rem; background-color: #FFD700; color: #032E8A; text-align: center; text-decoration: none; border-radius: 0.5rem; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#FFC000';" onmouseout="this.style.backgroundColor='#FFD700';">Banking Card</a>
                        </li>
                    </ul>
                    <button onclick="closeModal()" style="width: 100%; padding: 0.75rem 1rem; background-color: #6B7280; color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; margin-top: 1rem;" onmouseover="this.style.backgroundColor='#4B5563';" onmouseout="this.style.backgroundColor='#6B7280';">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('donateModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('donateModal').style.display = 'none';
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
    <footer style="background-color: #032E8A; color: white; padding: 2rem 0; text-align: center;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <p style="margin-bottom: 1rem;">&copy; 2024 Your Organization. All rights reserved.</p>
            <div>
                <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem; transition: color 0.3s ease;" onmouseover="this.style.color='#FFA500'" onmouseout="this.style.color='#FFD700'">About Us</a>
                <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem; transition: color 0.3s ease;" onmouseover="this.style.color='#FFA500'" onmouseout="this.style.color='#FFD700'">Contact Us</a>
            </div>
        </div>
    </footer>
</x-app-layout>

