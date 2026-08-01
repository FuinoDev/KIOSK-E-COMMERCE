<?php

session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
  
    echo "<script>
        alert('Access denied! Please log in first.');
        window.location.href = 'index.html';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FuinoWeb</title>
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap");</style>
</head>
<body>
<section class="header">
        <div>
            <ul id="navbar">
                <div class="main-links">
                    <li><a  class="active" href="dashboard.php">Home</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </div>
                <p class="fuino-text">FuinoPlant</p>
                <div class="auth-links">
                    <li><a href="index.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="index.html">Logout</a></li>
                    <li><a href="cart.html" class="cart-button"><i class='bx bx-cart'></i> Cart</a></li>
                </div>
            </ul>
        </div>
    </section>

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title" id="hero-title">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Nurture Nature with FuinoPlant, Grow Green Dreams.</p>
            <a href="product.html" class="hero-button">Shop Now</a>
        </div>
        <div class="product-card">
            <div class="product-image-container">
                <img src="../img/p1.webp" class="product-image" alt="Product Image 1">
            </div>
            <div class="product-info">
                <h4>Veggies For All</h4>
                <p>₱10 - ₱100</p>
                <p>AVERAGE RATES: 4.3</p>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half'></i>
                </div>
                <a href="product.html" class="product-button">Add to Cart</a>
            </div>
        </div>
    </section>

    <script src="../scripts/home.js"></script>
</body>
</html>
