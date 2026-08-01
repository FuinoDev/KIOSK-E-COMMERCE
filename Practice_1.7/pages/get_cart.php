<?php
session_start();
$cart = $_SESSION['cart'] ?? []; // Retrieve cart or default to empty
echo json_encode(['cart' => $cart]);
?>
