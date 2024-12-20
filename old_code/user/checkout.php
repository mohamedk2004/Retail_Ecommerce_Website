<?php
session_start();

// Ensure the cart exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Paymob credentials
$apiKey = "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRBeE16TTFPQ3dpYm1GdFpTSTZJakUzTXpRMk16TXhNamd1TkRNM01qUTJJbjAuNUc2QmRmU1dqMHZvcHY1dWUxNmIxbnJBcllpWkhBLVlKUlhKVGF4MUczTFowdHRVdmdLRGpjT2lubl9HdEtJTE9aX0xtX09BWVpuY1Nac190Y0dnS3c="; // Your provided API Key
$integrationId = "4904971"; // Your provided Integration ID
$iframeId = "889066"; // Your provided Iframe ID

// Calculate the cart total
$cartTotal = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $_SESSION['cart']));

// Helper function to make API requests and log responses
function makeApiRequest($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    $response = curl_exec($ch);

    if ($response === false) {
        file_put_contents('paymob_error_log.txt', "cURL Error: " . curl_error($ch) . "\n", FILE_APPEND);
        die("cURL Error: " . curl_error($ch));
    }

    // Log request and response
    file_put_contents('paymob_log.txt', "Request to $url:\n" . json_encode($data) . "\nResponse:\n" . $response . "\n", FILE_APPEND);

    curl_close($ch);
    return json_decode($response, true);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Authenticate
    $authResponse = makeApiRequest("https://accept.paymob.com/api/auth/tokens", ["api_key" => $apiKey]);
    if (!isset($authResponse['token'])) {
        die("Authentication failed: " . json_encode($authResponse));
    }
    $authToken = $authResponse['token'];

    // Step 2: Create Order
    $orderResponse = makeApiRequest("https://accept.paymob.com/api/ecommerce/orders", [
        "auth_token" => $authToken,
        "delivery_needed" => false,
        "amount_cents" => $cartTotal * 100, // Convert to cents
        "currency" => "EGP",
        "items" => array_map(function ($item) {
            return [
                "name" => $item['name'],
                "amount_cents" => $item['price'] * 100, // Convert to cents
                "quantity" => $item['quantity']
            ];
        }, $_SESSION['cart'])
    ]);
    if (!isset($orderResponse['id'])) {
        die("Order creation failed: " . json_encode($orderResponse));
    }
    $orderId = $orderResponse['id'];

    // Step 3: Generate Payment Key
    $paymentKeyResponse = makeApiRequest("https://accept.paymob.com/api/acceptance/payment_keys", [
        "auth_token" => $authToken,
        "amount_cents" => $cartTotal * 100, // Convert to cents
        "expiration" => 3600,
        "order_id" => $orderId,
        "billing_data" => [
            "apartment" => "NA",
            "email" => "customer@example.com",
            "floor" => "NA",
            "first_name" => "John",
            "last_name" => "Doe",
            "street" => "123 Real Street",
            "building" => "10",
            "phone_number" => "01000000000",
            "shipping_method" => "NA",
            "postal_code" => "12345",
            "city" => "Cairo",
            "country" => "EGY",
            "state" => "NA"
        ],
        "currency" => "EGP",
        "integration_id" => $integrationId
    ]);
    if (!isset($paymentKeyResponse['token'])) {
        die("Payment key generation failed: " . json_encode($paymentKeyResponse));
    }
    $paymentKey = $paymentKeyResponse['token'];

    // Redirect to Paymob iframe for payment
    $paymentUrl = "https://accept.paymob.com/api/acceptance/iframes/$iframeId?payment_token=$paymentKey";
    header("Location: $paymentUrl");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Order Summary</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-cart-message">Your cart is empty.</p>
    <?php else: ?>
        <ul class="list-group cart-items-summary">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center cart-item">
                    <div class="cart-item-image">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    </div>
                    <div class="cart-item-details">
                        <span class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></span>
                        <span class="cart-item-quantity">x<?php echo $item['quantity']; ?></span>
                    </div>
                    <span class="cart-item-price">EGP <?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <p class="cart-total"><strong>Total:</strong> EGP <?php echo number_format($cartTotal, 2); ?></p>
        <div class="d-flex justify-content-between mt-4">
            <a href="shopping_cart.php" class="btn btn-secondary">Continue Shopping</a>
            <form method="POST">
                <button type="submit" class="btn btn-success">Pay with Paymob</button>
            </form>
            <a href="cod_checkout.php" class="btn btn-primary">Cash on Delivery</a>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
