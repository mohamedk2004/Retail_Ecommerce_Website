<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <style>
    /* Custom Colors */
    :root {
        --primary-color: #071739;
        /* Dark Blue */
        --secondary-color: #4b6382;
        /* Light Blue */
        --accent-color-1: #A68868;
        /* Light Gold */
        --accent-color-2: #E3C39D;
        /* Light Beige */
        --bg-color-light: #F4F7FA;
        /* Light Gray */
        --text-light: white;
        /* White text */
        --text-dark: #071739;
        /* Dark text */
    }

    body {
        background-color: var(--bg-color-light);
        font-family: Arial, sans-serif;
    }

    .wishlist-container {
        margin-top: 30px;
    }

    .wishlist-header {
        text-align: center;
        color: var(--primary-color);
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: bold;
    }

    .wishlist-item {
        background-color: #ffffff;
        /* White background for items */
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        width: 300px;
        height: auto;
    }

    #wishlist-items {
        column-gap: 10px;
        justify-content: center;
    }

    .wishlist-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .wishlist-item h5 {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .wishlist-item img {
        max-width: 100%;
        height: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
        object-fit: cover;
        width: 150px;
        height: 150px;
        justify-content: center;
        justify-self: center;
        align-items: center;
        justify-items: center;
    }

    .wishlist-item p {
        margin: 0 0 10px;
        color: var(--text-dark);
    }

    .wishlist-item .btn-primary {
        background-color: var(--primary-color);
        color: var(--text-light);
        border-radius: 50px;
        width: 100%;
    }

    .wishlist-item .btn-primary:hover {
        background-color: var(--accent-color-1);
        color: var(--text-light);
    }

    .wishlist-item .btn-outline-secondary {
        border-radius: 50px;
        width: 100%;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <?php
// Simulated data for wishlist items
$wishlist_items = [
    ["title" => "M design Bottle 800mL", "price" => 120.00, "image" => "./assets./imgs/mdesign_bottle0.8_dimensions.png", "in_stock" => true],
    ["title" => "M design Lunch Set", "price" => 85.00, "image" => "M_DesignLunchSet.jpeg", "in_stock" => false],
    ["title" => "M design Lunch Box", "price" => 150.00, "image" => "All_Setd.954.png", "in_stock" => true]
];
?>

    <div class="container wishlist-container">
        <h2 class="wishlist-header">My Wishlist</h2>

        <!-- Display Wishlist Items -->
        <div class="row" id="wishlist-items">
            <?php foreach ($wishlist_items as $index => $item): ?>
            <div class="col-md-4 wishlist-item" data-index="<?php echo $index; ?>">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                <h5><?php echo $item['title']; ?></h5>
                <p><strong>Price: </strong><?php echo number_format($item['price'], 2); ?> LE </p>
                <p>Availability:
                    <span class="text-<?php echo $item['in_stock'] ? 'success' : 'danger'; ?>">
                        <?php echo $item['in_stock'] ? 'In Stock' : 'Out of Stock'; ?>
                    </span>
                </p>

                <!-- Buttons for Wishlist Item -->
                <button class="btn btn-primary" <?php if (!$item['in_stock']) echo 'disabled'; ?>>
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="btn btn-outline-secondary" onclick="removeItem(this)">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function removeItem(button) {
        // Find the parent wishlist item and remove it
        const wishlistItem = button.closest('.wishlist-item');
        wishlistItem.remove();
    }
    </script>

</body>

</html>