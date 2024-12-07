<x-app-layout>

    <div style="background-color: #032E8A; color: #ffffff; min-height: 100vh; padding: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <h1 style="font-size: 2.5rem; font-weight: bold; text-align: center; margin-bottom: 2rem; color: #FFD700;">
                Contact Us
            </h1>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Contact Form -->
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Send us a message</h2>
                    <form>
                        <div style="margin-bottom: 1rem;">
                            <label for="name" style="display: block; margin-bottom: 0.5rem;">Name</label>
                            <input type="text" id="name" name="name" required style="width: 100%; padding: 0.5rem; background-color: rgba(255, 255, 255, 0.2); color: white; border: none; border-radius: 0.25rem;">
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label for="email" style="display: block; margin-bottom: 0.5rem;">Email</label>
                            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.5rem; background-color: rgba(255, 255, 255, 0.2); color: white; border: none; border-radius: 0.25rem;">
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label for="message" style="display: block; margin-bottom: 0.5rem;">Message</label>
                            <textarea id="message" name="message" required rows="5" style="width: 100%; padding: 0.5rem; background-color: rgba(255, 255, 255, 0.2); color: white; border: none; border-radius: 0.25rem;"></textarea>
                        </div>
                        <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #FF4500; color: white; border: none; border-radius: 0.25rem; cursor: pointer;">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div style="background-color: rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Contact Information</h2>
                    <p style="margin-bottom: 1rem;">MerryMeal is here to support your needs. Feel free to reach out to us during our business hours.</p>
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: bold; margin-bottom: 0.5rem;">Address:</h3>
                        <p>123 Jalan Utama, Kuala Lumpur, Malaysia, 50000</p>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: bold; margin-bottom: 0.5rem;">Phone:</h3>
                        <p>+60 (3) 456-7890</p>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: bold; margin-bottom: 0.5rem;">Email:</h3>
                        <p>info@merrymeal.my</p>
                    </div>
                    <div>
                        <h3 style="font-weight: bold; margin-bottom: 0.5rem;">Business Hours:</h3>
                        <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                        <p>Saturday - Sunday: 9:00AM - 12:00AMPM</p>
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
