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

function updateCartContent()
{
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
        echo '<a href="checkout.php" class="btn  btn-block checkout-btn">Proceed to Checkout</a>';
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

    <style>
    :root {
        --primary-color: #071739;
        /* Dark Blue */
        --secondary-color: #4b6382;
        /* Light Blue */
        --accent-color-1: #A68868;
        /* Light Gold */
        --accent-color-2: #E3C39D;
        /* Light Beige */
        --bg-color-light: #CDD5DB;
        /* Light Gray */
        --bg-color-secondary: #A4B5C4;
        /* Light Blue-Gray */
        --text-light: white;
        /* White text */
        --text-dark: #071739;
        /* Dark text */
    }

    /* Override Bootstrap primary color */
    .btn-primary,
    .text-primary {
        background-color: var(--primary-color);
        color: var(--text-light);
    }

    /* Cart Sidebar Styles */
    .cart-sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        top: 0;
        right: 0;
        background-color: var(--bg-color-light);
        /* You can change this to var(--bg-color-light) if desired */
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .cart-sidebar-content {
        padding: 5px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .cart-sidebar a.closebtn {
        position: absolute;
        top: 15px;
        right: 25px;
        font-size: 36px;
        text-decoration: none;
        color: var(--text-dark);
    }

    /* Cart Icon Styles */
    .cart-icon {
        font-size: 1.5rem;
        cursor: pointer;
        position: relative;
    }

    .cart-count {
        background-color: red;
        /* Consider using a color variable for consistency */
        color: var(--text-light);
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 0.8rem;
        position: absolute;
        top: -5px;
        right: -10px;
    }

    /* Navbar Cart Container */
    .navbar .cart-container {
        margin-left: auto;
    }

    /* Total Price Styling */
    .total-price {
        width: 40px;
        min-width: 60px;
        text-align: right;
    }

    /* Quantity Control Styles */
    .quantity-control {
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        width: 10px;
        margin-left: 31px;
    }

    .quantity-control button {
        color: var(--text-dark);
        background: none;
        border: 1px solid var(--secondary-color);
        /* Using a color variable */
        border-radius: 30%;
        padding: 0;
        width: 30px;
        text-align: center;
    }

    .quantity-control span {
        margin-left: 50px;
        width: 30px;
        text-align: center;
    }

    .quantity-control button:hover {
        background: var(--primary-color);
        /* Use primary color on hover */
        color: var(--text-light);
    }

    /* Cart Items List */
    .cart-items-list .btn-danger {
        background-color: transparent;
        border: none;
        color: var(--accent-color-1);
        /* Using accent color for consistency */
        font-size: 20px;
        padding: 0;
        margin-left: 18px;
        transition: color 0.3s ease, transform 0.3s ease;
        transform: translate(-30px, -20px);
        position: relative;
    }

    .cart-items-list .btn-danger:hover {
        color: darkred;
        /* Consider using a color variable if you define one for hover states */
    }

    .cart-items-list .btn-danger i.bi-trash {
        vertical-align: middle;
    }

    .cart-items-list .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 10px;
        background-color: var(--bg-color-light);
        /* Using the light background color */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .cart-items-list .list-group-item:hover {
        background-color: var(--bg-color-secondary);
        /* Using a secondary background color on hover */
    }

    .cart-items-list .list-group-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 5px;
    }

    .cart-items-list .list-group-item .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
    }

    .cart-items-list .list-group-item .total-price {
        min-width: 80px;
        font-weight: bold;
        color: var(--text-dark);
        text-align: right;
    }

    .cart-items-list .list-group-item .btn-danger {
        font-size: 18px;
        color: var(--primary-color);
        /* Using accent color for delete button */
        background: none;
        border: none;
        padding: 0;
        margin-left: 20px;
    }

    .cart-items-list .list-group-item .btn-danger:hover {
        color: var(--accent-color-1);
        /* Change hover color to accent color */
        cursor: pointer;
    }

    /* Checkout Button */
    .checkout-btn {
        width: 100%;
        padding: 10px 0;
        font-size: 18px;
        background-color: var(--primary-color);
        /* Use primary color for checkout button */
        color: var(--text-light);
    }

    .checkout-btn:hover {
        background-color: var(--primary-color);
        color: var(--text-light);
    }
    </style>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function openCartSidebar() {
        document.getElementById("cartSidebar").style.width = "400px";
        updateCart(); // Update cart content on opening
    }

    function closeCartSidebar() {
        document.getElementById("cartSidebar").style.width = "0";
    }

    function addToCart(productName, productPrice, productImage) {
        $.post('', {
            product_name: productName,
            product_price: productPrice,
            product_image: productImage,
            ajax_request: 'add_to_cart'
        }, function(response) {
            if (response.status === 'success') {
                updateCartCount();
                updateCart(); // Update cart content
            }
        }, 'json');
    }

    function removeFromCart(index) {
        $.post('', {
            item_index: index,
            ajax_request: 'remove_item'
        }, function(response) {
            updateCart(); // Update cart content after removal
            updateCartCount(); // Update cart count after removal
        });
    }

    function changeQuantity(index, change) {
        $.post('', {
            item_index: index,
            quantity_change: change,
            ajax_request: 'change_quantity'
        }, function(response) {
            updateCart(); // Update cart content after quantity change
            updateCartCount(); // Update cart count after quantity change
        });
    }

    function updateCart() {
        $.post('', {
            ajax_request: 'update_cart'
        }, function(response) {
            $('#cartContent').html(response); // Update cart content in sidebar
        });
    }

    function updateCartCount() {
        $.post('', {
            ajax_request: 'update_cart_count'
        }, function(count) {
            $('#cartCount').text(count); // Update cart count in navbar
        });
    }

    function closeCartSidebar() {
        document.getElementById("cartSidebar").style.width = "0";
    }
    </script>
</body>

</html>