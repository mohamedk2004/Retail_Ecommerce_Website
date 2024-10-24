<?php
session_start();

// Ensure the cart exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function displayCartSummary() {
    if (empty($_SESSION['cart'])) {
        echo "<p class='empty-cart-message'>Your cart is empty.</p>";
    } else {
        echo '<ul class="list-group cart-items-summary">';
        foreach ($_SESSION['cart'] as $item) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center cart-item">';
            echo '<div class="cart-item-image">';
            echo '<img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '">';
            echo '</div>';
            echo '<div class="cart-item-details">';
            echo '<span class="cart-item-name">' . htmlspecialchars($item['name']) . '</span>';
            echo '<span class="cart-item-quantity">x' . $item['quantity'] . '</span>';
            echo '</div>';
            echo '<span class="cart-item-price">$' . number_format($item['price'] * $item['quantity'], 2) . '</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo '<hr>';
        echo '<p class="cart-total"><strong>Total:</strong> $' . number_format(array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart'])), 2) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
    --primary-color: #071739;       /* Dark Blue */
    --secondary-color: #4b6382;     /* Light Blue */
    --accent-color-1: #A68868;      /* Light Gold */
    --accent-color-2: #E3C39D;      /* Light Beige */
    --bg-color-light: #CDD5DB;      /* Light Gray */
    --bg-color-secondary: #A4B5C4;  /* Light Blue-Gray */
    --text-light: white;            /* White text */
    --text-dark: #071739;           /* Dark text */
}

/* Override Bootstrap primary color */
.btn-primary, .text-primary {
    background-color: var(--primary-color);
    color: var(--text-light);
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--bg-color-light);
}

.container {
    background-color: var(--text-light);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 30px;
    font-weight: 600;
    color: var(--text-dark);
}

.cart-items-summary {
    padding: 0;
}

.cart-item {
    padding: 15px 10px;
    border-bottom: 1px solid var(--bg-color-secondary);
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
}

.cart-item-details {
    display: flex;
    flex-direction: column;
}

.cart-item-name {
    font-size: 16px;
    font-weight: 500;
    color: var(--text-dark);
}

.cart-item-quantity {
    font-size: 14px;
    color: var(--secondary-color);
}

.cart-item-price {
    font-size: 16px;
    font-weight: bold;
    color: var(--accent-color-1);
}

.cart-total {
    font-size: 18px;
    font-weight: bold;
    text-align: right;
    color: var(--text-dark);
}

.empty-cart-message {
    text-align: center;
    font-size: 18px;
    color: #dc3545;
    padding: 20px;
}

.btn {
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 16px;
}

/* Secondary Button */
.btn-secondary {
    background-color: var(--secondary-color);
    border: none;
    color: var(--text-light);
}

.btn-secondary:hover {
    background-color: var(--primary-color);
}

/* Success Button */
.btn-success {
    background-color: var(--accent-color-1);
    border: none;
    color: var(--text-light);
}

.btn-success:hover {
    background-color: var(--accent-color-2);
}

    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Order Summary</h2>
    <?php displayCartSummary(); ?>
    
    <div class="d-flex justify-content-between mt-4">
        <a href="shopping_cart.php" class="btn btn-secondary">Continue Shopping</a>
        <a href="final_checkout.php" class="btn btn-success">Proceed to Final Checkout</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
