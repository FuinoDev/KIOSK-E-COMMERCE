<?php
session_start();

$input = file_get_contents('php://input');
$product = json_decode($input, true);


if (!isset($product['name'], $product['price'], $product['quantity'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing product data.']);
    exit;
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$exists = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $product['name']) {
        $item['quantity'] += $product['quantity'];
        $exists = true;
        break;
    }
}


if (!$exists) {
    $_SESSION['cart'][] = $product;
}

echo json_encode(['status' => 'success']);
?>
