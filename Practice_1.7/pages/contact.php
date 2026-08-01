<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact FuinoPlant</title>
    <link rel="stylesheet" href="../styles/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap");
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .popup-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 500;
        }
        .popup-button {
            margin-top: 10px;
            padding: 10px 20px;
            background: linear-gradient(to bottom right, #ee37ff, rgb(5, 99, 36));
            color:rgb(255, 255, 255);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 800;
        }
        .popup-button:hover {
            background: linear-gradient(to bottom right, #72535d, #ff0055);
        }
    </style>
</head>
<body>
    <section class="header">
        <div>
            <ul id="navbar">
                <div class="main-links">
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a  class="active" href="contact.php">Contact</a></li>
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
    <section class="contact" id="contact">
        <div class="contact-content">
            <h2 class="wave-bounce">Hi luds</h2>
            <p>We'd love to hear from you! Whether you have a question, feedback, or just want to say hello, feel free to reach out to us. Fill out the form below, and we'll get back to you as soon as possible.</p>
            <form action="submit_contact.php" method="post" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="contact-button">Send Message</button>
            </form>
            <div class="contact-info">
                <h3>Our Contact Details</h3>
                <p><i class='bx bx-map'></i> Address: 123 Green Street, Quezon City, Philippines</p>
                <p><i class='bx bx-phone'></i> Phone: +63 123 456 7890</p>
                <p><i class='bx bx-envelope'></i> Email: support@fuinoplant.com</p>
            </div>
        </div>
    </section>

 
    <div id="popup" class="popup">
        <div class="popup-content">
            <p id="popup-message"></p>
            <button onclick="closePopup()" class="popup-button">Close</button>
        </div>
    </div>

  
    <script>
 
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get("message");

            if (message) {
                document.getElementById("popup-message").innerText = decodeURIComponent(message);
                document.getElementById("popup").style.display = "flex";
            }
        });

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</body>
</html>
