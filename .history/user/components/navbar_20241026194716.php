<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #A4B5C4; position: sicky;">
        <div class="container">
            <a class="navbar-brand" href="#">BRAND</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="home_page.php">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="product_page.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="customer_and_help.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="wishlist.php">Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="shopping_cart.php">Cart</a></li>
                </ul>
                <form class="d-flex me-3">
                    <div class="input-group rounded-pill">
                        <input class="form-control search-input rounded-pill" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn search-button rounded-pill" type="submit">
                            <i class="bi bi-search"></i> <!-- Search icon -->
                        </button>
                    </div>
                </form>
                <div class="dropdown me-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Language
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Arabic</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>