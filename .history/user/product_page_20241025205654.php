<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .filter-section {
        padding: 20px;
    }

    .filter-section h5 {
        margin-bottom: 15px;
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-card {
        margin-bottom: 30px;
    }

    .product-card .btn {
        margin-top: 10px;
    }

    .rating-stars {
        color: #FFD700;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    e "navbar.php"; ?>

    <!-- Hero Section -->
    <section class="bg-light py-5 text-center">
        <h1>Product Catalog</h1>
        <p>Browse our wide selection of products</p>
    </section>

    <!-- Filters and Products Section -->
    <section class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-md-3 filter-section bg-light p-3 rounded">
                <h5>Filters</h5>

                <!-- Category Filter -->
                <div class="mb-4">
                    <label class="form-label">Category</label>
                    <select class="form-select">
                        <option selected>All Categories</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Home & Kitchen</option>
                        <option>Beauty & Personal Care</option>
                    </select>
                </div>

                <!-- Price Filter -->
                <div class="mb-4">
                    <label class="form-label">Price</label>
                    <input type="range" class="form-range" min="0" max="1000" step="50">
                    <div class="d-flex justify-content-between">
                        <span>$0</span>
                        <span>$1000</span>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="mb-4">
                    <label class="form-label">Rating</label>
                    <select class="form-select">
                        <option selected>All Ratings</option>
                        <option>5 Stars</option>
                        <option>4 Stars & Up</option>
                        <option>3 Stars & Up</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button class="btn btn-primary w-100">Apply Filters</button>
            </div>

            <!-- Products Listing -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Sorting -->
                    <div>
                        <label class="form-label">Sort By</label>
                        <select class="form-select d-inline-block w-auto">
                            <option selected>Newest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Rating</option>
                        </select>
                    </div>
                    <!-- Pagination -->
                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="row">
                    <?php
                    // Example product data (replace with database fetch or real data)
                    $products = [
                        ["name" => "Smartphone", "price" => 299.99, "rating" => 4, "stock" => "In Stock", "image" => "https://via.placeholder.com/300x200"],
                        ["name" => "Laptop", "price" => 899.99, "rating" => 5, "stock" => "In Stock", "image" => "https://via.placeholder.com/300x200"],
                        ["name" => "Headphones", "price" => 99.99, "rating" => 3, "stock" => "In Stock", "image" => "https://via.placeholder.com/300x200"],
                        ["name" => "Smartwatch", "price" => 199.99, "rating" => 4, "stock" => "In Stock", "image" => "https://via.placeholder.com/300x200"]
                    ];

                    foreach ($products as $product) {
                        echo '
                    <div class="col-md-4">
                        <div class="card product-card shadow-sm">
                            <img src="' . $product["image"] . '" class="card-img-top" alt="' . $product["name"] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $product["name"] . '</h5>
                                <p class="card-text">$' . $product["price"] . '</p>
                                <p class="card-text"><span class="badge bg-success">' . $product["stock"] . '</span></p>
                                <div class="rating-stars">';
                        for ($i = 0; $i < $product["rating"]; $i++) {
                            echo '<i class="bi bi-star-fill"></i>';
                        }
                        echo '      </div>
                                <button class="btn btn-primary">Add to Cart</button>
                                <button class="btn btn-outline-secondary">Add to Wishlist</button>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center p-4 bg-dark text-white">
        <p>© 2024 Your Website Name. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>