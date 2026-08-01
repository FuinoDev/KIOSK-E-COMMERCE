<?php
session_start();
$cart_items = $_SESSION['cart'] ?? []; // Retrieve cart items from session or set to empty

// Calculate the total amount
$total_amount = 0;
foreach ($cart_items as $item) {
    $total_amount += $item['price'] * $item['quantity']; // Price multiplied by quantity
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - FuinoPlant</title>
    <link rel="stylesheet" href="../styles/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');</style>
</head>
<body>
    <header class="header">
        <ul id="navbar">
            <li class="logo">
                <span class="fuino-text">FuinoPlant</span>
            </li>
            <li class="header-title">
                <span class="header-checkout">Checkout</span>
            </li>
            <li class="auth-links">
                <button class="cart-button">
                    <i class="bx bx-cart"></i> Cart
                </button>
            </li>
        </ul>
    </header>

  
    <section class="checkout-container">
        <form id="checkout-form">
            <h2 class="form-title">Complete Your Order</h2>

        
            <div class="form-group">
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="address">Delivery Address</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter your delivery address" required></textarea>
            </div>

            <div class="form-group">
                <label for="payment-method">Payment Method</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="ewallet">eWallet</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>

         
            <div class="order-summary">
                <h3>Order Summary</h3>
                <p>Total Amount: ₱<span id="order-total"><?php echo number_format($total_amount, 2); ?></span></p>
            </div>

            <button type="submit" class="checkout-button">Place Order</button>
        </form>
    </section>

    
    <div id="popup" class="popup">
        <div class="popup-content">
            <p id="popup-message"></p>
            <button onclick="closePopup()" class="popup-button">Close</button>
        </div>
    </div>

    <script>
        document.getElementById("checkout-form").addEventListener("submit", function (event) {
            event.preventDefault(); 

            const formData = new FormData(this); 

           
            fetch("process_checkout.php", {
                method: "POST",
                body: formData
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        showPopup(`Thank you, ${data.full_name}! Your order has been placed successfully.`);
                        this.reset();
                    } else {
                        showPopup(data.message || "Something went wrong. Please try again.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showPopup("An unexpected error occurred. Please try again.");
                });
        });

    
        function showPopup(message) {
            document.getElementById("popup-message").innerText = message;
            document.getElementById("popup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</body>
</html>
