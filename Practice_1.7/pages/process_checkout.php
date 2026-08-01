<?php
session_start();
$conn = new mysqli("localhost", "root", "", "e_commerse");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = htmlspecialchars($_POST["full_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $address = htmlspecialchars($_POST["address"]);
    $payment_method = htmlspecialchars($_POST["payment_method"]);
    $cart_items = $_SESSION["cart"] ?? [];

    if (empty($cart_items)) {
        echo json_encode(["status" => "error", "message" => "Your cart is empty."]);
        exit;
    }

    // Insert order details into `orders` table
    $order_query = "INSERT INTO orders (full_name, email, address, payment_method) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("ssss", $full_name, $email, $address, $payment_method);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insert cart items into `order_items` table
        $item_query = "INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_query);

        foreach ($cart_items as $item) {
            $item_stmt->bind_param("isii", $order_id, $item["name"], $item["quantity"], $item["price"]);
            $item_stmt->execute();
        }

        $item_stmt->close();
        unset($_SESSION["cart"]); // Clear the cart after successful order placement

        echo json_encode(["status" => "success", "full_name" => $full_name, "message" => "Order placed successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Unable to place the order."]);
    }

    $stmt->close();
}

$conn->close();
?>
