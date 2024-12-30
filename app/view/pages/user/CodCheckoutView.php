<?php
// View: Handles presentation logic for cod_checkout (HTML and output)

function renderCodCheckoutForm() {
    echo '<form method="POST" action="cod_checkout_controller.php">';
    echo '<label for="name">Name:</label>';
    echo '<input type="text" name="name" id="name" required><br>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" name="email" id="email" required><br>';
    echo '<label for="address">Address:</label>';
    echo '<textarea name="address" id="address" required></textarea><br>';
    echo '<button type="submit">Checkout</button>';
    echo '</form>';
}

function renderCodCheckoutError($message) {
    echo "<p style='color:red;'>Error: $message</p>";
}

function renderCodCheckoutSuccess() {
    echo "<p style='color:green;'>Your order has been placed successfully!</p>";
}
?>