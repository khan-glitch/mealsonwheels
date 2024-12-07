<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals on Wheels</title>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: "Roboto", sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 0.5rem;
    font-weight: 500;
}

.navbar a:hover {
    text-decoration: underline;
}

/* Hero Section */
.hero {
    background-color: #023e8a;
    color: white;
    text-align: center;
    padding: 4rem 2rem;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.hero a {
    display: inline-block;
    padding: 0.75rem 2rem;
    background-color: #0077b6;
    color: white;
    text-decoration: none;
    font-size: 1rem;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.hero a:hover {
    background-color: #005f91;
}

/* Main Content */
.content {
    padding: 2rem;
    text-align: center;
}

.content h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.content p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 2rem;
}

/* Cards Section */
.cards {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

/* Card Styles */
.card {
    background-color: white;
    border: none;
    border-radius: 8px;
    width: 300px;
    text-align: center;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card h3 {
    background: white;
    font-size: 1.5rem;
    margin: 0;
    padding: 1rem 0;
    z-index: 1;
}

.card-image {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.card-image:hover img {
    transform: scale(1.1);
}

.card-hover-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    text-align: center;
    padding: 1rem;
}

.card-image:hover .card-hover-content {
    opacity: 1;
}
/* Button Styling */
.card-button {
    display: inline-block;
    margin: 1rem 0;
    padding: 0.5rem 1.5rem;
    background-color: #0077b6;
    color: white;
    text-decoration: none;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.card-button:hover {
    background-color: #005f91;
    transform: scale(1.05);
}

/* Footer */
footer {
    background-color: #023e8a;
    color: white;
    text-align: center;
    padding: 2rem 1rem;
    margin-top: 2rem;
}

footer a {
    color: #f9d71c;
    text-decoration: none;
    margin: 0 0.5rem;
}

footer a:hover {
    text-decoration: underline;
}
</style>

</head>
<body>
    @include('layouts.navigation')


    <!-- Hero Section -->
    <section class="hero">
        <h1>Delivering Hope, One Meal at a Time</h1>
        <p>Join us in making a difference. Every meal counts!</p>
        <a href="/donor">Donate Now</a>
    </section>

    <!-- Main Content -->
    <main class="content">
        <h2>Our Mission</h2>
        <p>
            Meals on Wheels is dedicated to providing nutritious meals to those in need.
            We aim to combat hunger and isolation for our community's most vulnerable members.
        </p>

          <!-- Cards Section -->
    <div class="cards">
        <!-- Card 1 -->
        <div class="card">
            <h3>Register</h3>
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1534850336045-c6c6d287f89e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Register">
                <div class="card-hover-content">
                    <p>Join our community and make a difference by supporting our mission.</p>
                </div>
            </div>
            <a href="/register" class="card-button">Register</a>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <h3>Delicious Meals</h3>
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1496080174650-637e3f22fa03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Delicious Meals">
                <div class="card-hover-content">
                    <p>Enjoy nutritious and freshly prepared meals delivered to your doorstep.</p>
                </div>
            </div>
            <a href="/orders" class="card-button">Order Now</a>
        </div>

        <!-- Card 3 -->
        <div class="card">
            <h3>Delivery</h3>
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1496080174650-637e3f22fa03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Delivery">
                <div class="card-hover-content">
                    <p>Our dedicated team ensures timely delivery of meals every day.</p>
                </div>
            </div>
            <a href="/delivery" class="card-button">Track Delivery</a>
        </div>

        <!-- Card 4 -->
        <div class="card">
            <h3>Donate</h3>
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Donate">
                <div class="card-hover-content">
                    <p>Your generous donations help us reach more people in need.</p>
                </div>
            </div>
            <a href="/donate" class="card-button">Donate Now</a>
        </div>

        <!-- Card 5 -->
        <div class="card">
            <h3>Community Impact</h3>
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Community Impact">
                <div class="card-hover-content">
                    <p>Be part of the change. See how your contributions transform lives.</p>
                </div>
            </div>
            <a href="/about is" class="card-button">See Impact</a>
        </div>
    </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Meals on Wheels. All rights reserved.</p>
        <a href="#donor">Donor Page</a>
        <a href="#terms">Terms of Service</a>
        <a href="#privacy">Privacy Policy</a>
        <a href="#careers">Careers</a>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Function to toggle sidebar visibility
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
