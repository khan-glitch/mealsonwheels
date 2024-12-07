<x-app-layout>
    <div style="background-color: #032E8A; color: #ffffff; min-height: 100vh; padding: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <h1 style="font-size: 2.5rem; font-weight: bold; text-align: center; margin-bottom: 2rem; color: #FFD700;">
                About Us
            </h1>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Company Overview -->
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Our Story</h2>
                    <p style="margin-bottom: 1rem;">
                    MerryMeal began with a simple vision: to bring comfort and nourishment to those who need it most. What started as a small community effort has grown into a nationwide initiative, reaching countless individuals who struggle with meal preparation due to age, illness, or disability. Our journey has been shaped by the collective power of compassion and the unwavering support of our volunteers, partners, and donors.
                    </p>
                    <p style="margin-bottom: 1rem;">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <h3 style="font-size: 1.25rem; font-weight: bold; margin-top: 1.5rem; margin-bottom: 0.5rem;">Our Mission</h3>
                    <p>
                    Over the years, we have partnered with local food service providers and dedicated volunteers to ensure that no one is left behind. By leveraging technology and a network of kitchens, we deliver meals efficiently, even to those in remote areas. Each meal represents not just sustenance but a reminder that someone cares.
                    </p>
                </div>

                <!-- Types of meals -->
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Types of Meals Served</h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div style="text-align: center;">
                            <img src="{{ asset('images/breakfast.jpg') }}" alt="Breakfast" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold;">Breakfast</h3>
                            <p style="color: #FFD700;">Healthy and Warm</p>
                        </div>
                        <div style="text-align: center;">
                            <img src="{{ asset('images/lunch.jpg') }}" alt="Lunch" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold;">Lunch</h3>
                            <p style="color: #FFD700;">Nutritious and Delicious</p>
                        </div>
                        <div style="text-align: center;">
                            <img src="{{ asset('images/dinner.jpg') }}" alt="Dinner" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold;">Dinner</h3>
                            <p style="color: #FFD700;">Just like Mom's cook</p>
                        </div>
                        <div style="text-align: center;">
                            <img src="{{ asset('images/dessert.jpg') }}" alt="Dessert" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: bold;">Dessert</h3>
                            <p style="color: #FFD700;">Sweet and Savory</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div style="margin-top: 2rem; background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; text-align: center;">Our Values</h2>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                    <div style="text-align: center;">
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem;">Quality</h3>
                        <p>We are committed to providing the highest quality meals to our customers.</p>
                    </div>
                    <div style="text-align: center;">
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem;">Innovation</h3>
                        <p>We constantly strive to innovate and improve our menu and services.</p>
                    </div>
                    <div style="text-align: center;">
                        <h3 style="font-size: 1.25rem; font-weight: bold; color: #FFD700; margin-bottom: 0.5rem;">Community</h3>
                        <p>We believe in giving back to the community and supporting local initiatives.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
    <p>&copy; 2024 Meals on Wheels. All rights reserved.</p>
    <div>
        <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
        <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
    </div>
</footer>

</x-app-layout>
