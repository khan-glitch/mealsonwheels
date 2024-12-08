<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals on Wheels</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #032E8A;
            color: #ffffff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .hero {
            text-align: center;
            padding: 4rem 2rem;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #FFD700;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: #FFD700;
            color: #032E8A;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #FFC000;
        }
        .content {
            padding: 2rem;
            text-align: center;
        }
        .content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #FFD700;
        }
        .cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            width: 300px;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            font-size: 1.5rem;
            margin: 0;
            padding: 1rem 0;
            color: #FFD700;
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
        .card:hover .card-image img {
            transform: scale(1.1);
        }
        .card-hover-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(3, 46, 138, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 1rem;
        }
        .card:hover .card-hover-content {
            opacity: 1;
        }
        .card-button {
            display: inline-block;
            margin: 1rem 0;
            padding: 0.5rem 1.5rem;
            background-color: #FFD700;
            color: #032E8A;
            text-decoration: none;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .card-button:hover {
            background-color: #FFC000;
            transform: scale(1.05);
        }
        footer {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            text-align: center;
            padding: 2rem 1rem;
            margin-top: 2rem;
        }
        footer a {
            color: #FFD700;
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

    <section class="hero">
        <div class="container">
            <h1>Delivering Hope, One Meal at a Time</h1>
            <p>Join us in making a difference. Every meal counts!</p>
            <a href="/donor" class="btn">Donate Now</a>
        </div>
    </section>

    <main class="content">
        <div class="container">
            <h2>Our Mission</h2>
            <p>
                Meals on Wheels is dedicated to providing nutritious meals to those in need.
                We aim to combat hunger and isolation for our community's most vulnerable members.
            </p>

            <div class="cards">
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

                <div class="card">
                    <h3>Community Impact</h3>
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Community Impact">
                        <div class="card-hover-content">
                            <p>Be part of the change. See how your contributions transform lives.</p>
                        </div>
                    </div>
                    <a href="/about" class="card-button">See Impact</a>
                </div>
            </div>
        </div>
    </main>

   <!-- Footer Section -->
   <footer style="background-color: #032E8A; color: white; padding: 2rem; text-align: center;">
    <p>&copy; 2024 Meals on Wheels. All rights reserved.</p>
    <div>
        <a href="/about" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">About Us</a>
        <a href="/contact" style="color: #FFD700; text-decoration: none; margin: 0 1rem;">Contact Us</a>
    </div>
</footer>
</body>
</html>

