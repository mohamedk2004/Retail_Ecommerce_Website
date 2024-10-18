<?php
session_start();

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add items to the cart
if (isset($_POST['product_name']) && isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'add_to_cart') {
    $itemIndex = array_search($_POST['product_name'], array_column($_SESSION['cart'], 'name'));
    
    if ($itemIndex !== false) {
        // Item already in cart, increment quantity
        $_SESSION['cart'][$itemIndex]['quantity']++;
    } else {
        // New item, add to cart
        $item = [
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'image' => $_POST['product_image'],
            'quantity' => 1 // Start with a quantity of 1
        ];
        $_SESSION['cart'][] = $item;
    }
    
    echo json_encode(['status' => 'success']);
    exit;
}

// Remove item from cart
if (isset($_POST['item_index']) && isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'remove_item') {
    $itemIndex = $_POST['item_index'];
    unset($_SESSION['cart'][$itemIndex]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
    updateCartContent();
    exit;
}

// Change item quantity in cart
if (isset($_POST['item_index']) && isset($_POST['quantity_change']) && isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'change_quantity') {
    $itemIndex = $_POST['item_index'];
    $quantityChange = (int)$_POST['quantity_change'];

    // Ensure quantity stays at or above 1
    if ($_SESSION['cart'][$itemIndex]['quantity'] + $quantityChange > 0) {
        $_SESSION['cart'][$itemIndex]['quantity'] += $quantityChange;
    }

    updateCartContent();
    exit;
}

// Output cart content via AJAX
if (isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'update_cart') {
    updateCartContent();
    exit;
}

// Return total number of items in the cart (quantity-based)
if (isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'update_cart_count') {
    echo array_sum(array_column($_SESSION['cart'], 'quantity'));
    exit;
}

function updateCartContent() {
    if (empty($_SESSION['cart'])) {
        echo "<p>Your cart is empty.</p>";
    } else {
        echo '<ul class="list-group cart-items-list" style="max-height: 300px; overflow-y: auto;">';
        foreach ($_SESSION['cart'] as $index => $item) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
            echo '<img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '" style="width: 50px; height: 50px; margin-right: 10px;">';
            echo htmlspecialchars($item['name']);
            echo '<div class="quantity-control d-flex " style="width: 150px;">'; // Fixed width for alignment
            echo '<button class="btn btn-secondary btn-sm" onclick="changeQuantity(' . $index . ', -1)">-</button>';
            echo '<span class="mx-2" style="width: 40px; text-align: center;">' . $item['quantity'] . '</span>'; // Fixed width for quantity display
            echo '<button class="btn btn-secondary btn-sm" onclick="changeQuantity(' . $index . ', 1)">+</button>';
            echo '</div>';
            echo '<span class="total-price" style="min-width: 80px; text-align: right;">$' . number_format($item['price'] * $item['quantity'], 2) . '</span>'; // Fixed width for price
            echo '<button class="btn btn-danger btn-sm" onclick="removeFromCart(' . $index . ')"><i class="bi bi-trash"></i></button>';
            echo '</li>';
        }
        echo '</ul>';
        echo '<hr>';
       
        echo '<p><strong>Total:</strong> $' . number_format(array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart'])), 2) . '</p>';
        echo '<div class="text-center">';
        echo '<a href="checkout.php" class="btn btn-success btn-block checkout-btn">Proceed to Checkout</a>';
        echo '</div>';
    }
}

$totalItems = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link" href="#">Home</a>
                    <a class="nav-link" href="#">Products</a>
                    <a class="nav-link" href="#">Contact</a>
                </div>
                <div class="cart-container">
                    <span class="cart-icon" onclick="openCartSidebar()">
                        <i class="bi bi-cart"></i>
                        <span class="cart-count" id="cartCount"><?= $totalItems; ?></span>
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Products</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product1.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$10.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 1', 10.00, 'product1.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product2.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$20.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 2', 20.00, 'product2.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product3.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$30.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 3', 30.00, 'product3.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product4.jpg" class="card-img-top" alt="Product 4">
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">$15.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 4', 15.00, 'product4.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product5.jpg" class="card-img-top" alt="Product 5">
                    <div class="card-body">
                        <h5 class="card-title">Product 5</h5>
                        <p class="card-text">$25.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 5', 25.00, 'product5.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product6.jpg" class="card-img-top" alt="Product 6">
                    <div class="card-body">
                        <h5 class="card-title">Product 6</h5>
                        <p class="card-text">$35.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 6', 35.00, 'product6.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product7.jpg" class="card-img-top" alt="Product 7">
                    <div class="card-body">
                        <h5 class="card-title">Product 7</h5>
                        <p class="card-text">$40.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 7', 40.00, 'product7.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="product8.jpg" class="card-img-top" alt="Product 8">
                    <div class="card-body">
                        <h5 class="card-title">Product 8</h5>
                        <p class="card-text">$50.00</p>
                        <button class="btn btn-primary" onclick="addToCart('Product 8', 50.00, 'product8.jpg')">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="cartSidebar" class="cart-sidebar">
        <div class="cart-sidebar-content">
            <a href="javascript:void(0)" class="closebtn" onclick="closeCartSidebar()">&times;</a>
            <h2>Your Cart</h2>
            <div id="cartContent">
                <?php updateCartContent(); ?>
            </div>
        </div>
    </div>


    </script>
</body>

</html>