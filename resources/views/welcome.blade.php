<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals on Wheels</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #0077b6;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 1rem 2rem;
            align-items: center;
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

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
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

        .content .cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
/* Card Styles */
.card {
    background-color: white;
    border: 1px solid #ccc; /* Reduced border thickness */
    border-radius: 8px;
    padding: 1rem; /* Reduced padding */
    width: 300px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Card Image */
.card img {
    width: 100%;
    height: 200px; /* Fixed height */
    object-fit: cover; /* Ensure images fit without distortion */
    border-radius: 8px 8px 0 0; /* Match border-radius of the card */
    margin-bottom: 0.5rem; /* Reduced gap between image and content */
}

        .card h3 {
            font-size: 1.5rem;
            margin: 1rem 0;
        }

        .card p {
            font-size: 0.95rem;
            line-height: 1.4;
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
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Meals on Wheels</div>
        <div>
            <a href="#donate">Donate</a>
            <a href="#meals">Meals</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact Us</a>
            @auth
                <a href="/dashboard">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn" style="background: none; border: none; color: #ffffff; text-decoration: none; cursor: pointer; font-size: 16px;">
                        {{ __('Log Out') }}
                    </button>
                </form>
            @else
                <a href="/login">Log In</a>
                <a href="/register">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Delivering Hope, One Meal at a Time</h1>
        <p>Join us in making a difference. Every meal counts!</p>
        <a href="#donate">Donate Now</a>
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
            <div class="card">
                <img src="https://images.unsplash.com/photo-1534850336045-c6c6d287f89e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Register">
                <h3>Register</h3>
                <p>Join our community and make a difference by supporting our mission.</p>
            </div>
            <div class="card">
                <img src="https://images.unsplash.com/photo-1496080174650-637e3f22fa03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Delicious Meals">
                <h3>Delicious Meals</h3>
                <p>Enjoy nutritious and freshly prepared meals delivered to your doorstep.</p>
            </div>
            <div class="card">
                <img src="https://images.unsplash.com/photo-1496080174650-637e3f22fa03?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Delivery">
                <h3>Delivery</h3>
                <p>Our dedicated team ensures timely delivery of meals every day.</p>
            </div>
            <div class="card">
                <img src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Donate">
                <h3>Donate</h3>
                <p>Your generous donations help us reach more people in need.</p>
            </div>
            <div class="card">
                <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Community Impact">
                <h3>Community Impact</h3>
                <p>Be part of the change. See how your contributions transform lives.</p>
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
</body>
</html>
