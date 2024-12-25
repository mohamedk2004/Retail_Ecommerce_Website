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
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($cart as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 50px; height: 50px;">
                        <?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?>
                    </div>
                    <div>
                        EGP <?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="mt-3"><strong>Total:</strong> EGP <?= number_format($cartTotal, 2) ?></p>
        <form method="POST" action="/checkout/process">
            <button type="submit" class="btn btn-success">Pay with Paymob</button>
        </form>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>