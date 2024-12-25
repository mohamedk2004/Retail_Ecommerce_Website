<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash on Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 40px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Cash on Delivery</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <div class="text-center">
            <a href="shopping_cart.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
    <?php else: ?>
        <form method="POST">
            <div class="mb-4">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" required></textarea>
            </div>
            <div class="mb-4">
                <label for="floor" class="form-label">Floor</label>
                <input type="text" id="floor" name="floor" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Place Order</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>