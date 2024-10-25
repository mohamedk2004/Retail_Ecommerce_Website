<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details & Reviews</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom Colors */
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

        body {
            background-color: var(--bg-color-light);
            font-family: 'Arial', sans-serif;
        }

        h2, h4 {
            color: var(--primary-color);
        }

        .btn-primary, .text-primary {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: var(--text-light);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(29%) sepia(18%) saturate(3602%) hue-rotate(172deg) brightness(91%) contrast(93%);
        }

        .product-details {
            margin-top: 20px;
        }

        .product-slider img {
            width: 100%;
            height: auto;
        }

        .product-info {
            padding-left: 20px;
        }

        .reviews {
            margin-top: 40px;
        }

        .review-form, .review {
            background-color: var(--bg-color-secondary);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rating label {
            color: var(--bg-color-secondary);
            font-size: 24px;
            cursor: pointer;
            padding-right: 5px;
        }

        .rating label:hover, .rating label.active {
            color: var(--accent-color-1);
        }

        .review p {
            margin-top: 10px;
            color: var(--text-dark);
        }

        hr {
            color: var(--primary-color);
            font-weight: bold;
        }

        /* Redesign Review Cards */
        .review {
            border-left: 5px solid var(--accent-color-1);
            padding-left: 15px;
            background-color: #f5f7fa;
        }

        .review h5 {
            color: var(--primary-color);
            font-weight: bold;
        }

        .review .rating-stars {
            color: var(--accent-color-1);
        }

        /* Styling the rating stars */
        .rating-stars input[type="radio"] {
            display: none;
        }

        .rating-stars i {
            color: var(--bg-color-secondary);
        }

        .rating-stars input[type="radio"]:checked ~ i {
            color: var(--accent-color-1);
        }

        .rating-stars i:hover,
        .rating-stars i:hover ~ i {
            color: var(--accent-color-1);
        }

        .related-products .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }/* Prevent hover color change on reviewed stars */
.disabled-stars i {
    color: var(--accent-color-1); /* Static gold color */
    pointer-events: none;         /* Disable all hover/click events */
    transition: none;             /* Remove any transition effects */
}

/* Remove hover styling specifically for .disabled-stars */
.rating-stars:not(.disabled-stars) i:hover,
.rating-stars:not(.disabled-stars) i:hover ~ i {
    color: var(--accent-color-1); /* Gold color for hover on non-reviewed stars */

}
    </style>
</head>
<body>

<?php
// Static data for product and reviews
$product_title = "M-Design lunch set 2.1L";
$product_price = 350;
$product_stock = true;
$product_description = "Our 3-piece lunch set is an essential for busy parents and students. It includes a BPA-free and food-safe lunch box, a leakproof water bottle, and a 3-piece cutlery set inside the box.";
$product_specifications = "
- 2100 ml Fresco Lunch Box
- 800ml Water Bottle
- Cutlery
- Dishwasher, microwave safe & freezer safe
- 100% Food Safe
- BPA free.";
$product_images = ["M_DesignLunchSet.jpeg", "SET_2.1_TEALORANGE.jpg", "All_setd.954.png", "mdesign_bottle0.8_dimensions.png"];
$reviews = [
    ["name" => "Maha Refaat", "rating" => 4, "review" => "Great product!", "date" => "2024-10-10"],
    ["name" => "Fatma Osama", "rating" => 5, "review" => "Exceeded my expectations!", "date" => "2024-10-08"],
    ["name" => "Ahmed Mostafa", "rating" => 3, "review" => "Good, but could be better.", "date" => "2024-10-06"]
];
$related_products = [
    ["title" => "Product 1", "price" => 80.00, "image" => "https://via.placeholder.com/200"],
    ["title" => "Product 2", "price" => 95.00, "image" => "https://via.placeholder.com/200"]
];
?>

<div class="container product-details">
    <div class="row">
        <!-- Product Image Slider -->
        <div class="col-md-6 product-slider">
            <div id="carouselProductImages" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($product_images as $index => $image): ?>
                        <div class="carousel-item <?php if ($index == 0) echo 'active'; ?>">
                            <img src="<?php echo $image; ?>" alt="Product Image <?php echo $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselProductImages" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carouselProductImages" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-md-6 product-info">
            <h2><?php echo $product_title; ?></h2><hr>
            <h4><?php echo number_format($product_price, 2); ?> LE</h4>
            <p>Availability: <span class="text-<?php echo $product_stock ? 'success' : 'danger'; ?>">
                <?php echo $product_stock ? 'In Stock' : 'Out of Stock'; ?>
            </span></p>
            <p><strong>Description:</strong> <?php echo $product_description; ?></p>
            <p><strong>Specifications:</strong> <?php echo nl2br($product_specifications); ?></p>
            <div class="mb-3">
                <label for="color" class="form-label"><strong>Color:</strong></label>
                <select class="form-select" id="color">
                    <option>Teal - Orange</option>
                    <option>Orange - Pink</option>
                    <option>Pink - Teal</option>
                </select>
            </div>
            <button class="btn btn-primary">Add to Cart</button>
            <button class="btn btn-outline-secondary">Add to Wishlist</button>
        </div>
    </div>

    <!-- Customer Reviews & Ratings -->
    <div class="row reviews">
        <div class="col-md-12">
            <h4>Customer Reviews</h4>
            <?php foreach ($reviews as $review): ?>
                <div class="mb-3">
                    <div class="review">
                        <div class="review-header">
                            <h5><?php echo $review['name']; ?></h5>
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : ''; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p><em><?php echo $review['date']; ?></em></p>
                        <p><?php echo $review['review']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<!-- Review Form -->
<h2>Leave a Review</h2>
<div class="review-form">
    <form action="" method="POST">
        <!-- Rating System -->
        <div class="mb-3">
            <label for="rating" class="form-label"><strong>Your Rating:</strong></label>
            <div class="rating-stars1">
                <!-- Font Awesome stars with hover and click functionality -->
                <i class="fas fa-star" id="starr1" onclick="rate(1)" onmouseover="hoverStars(1)" onmouseout="resetStars()"></i>
                <i class="fas fa-star" id="starr2" onclick="rate(2)" onmouseover="hoverStars(2)" onmouseout="resetStars()"></i>
                <i class="fas fa-star" id="starr3" onclick="rate(3)" onmouseover="hoverStars(3)" onmouseout="resetStars()"></i>
                <i class="fas fa-star" id="starr4" onclick="rate(4)" onmouseover="hoverStars(4)" onmouseout="resetStars()"></i>
                <i class="fas fa-star" id="starr5" onclick="rate(5)" onmouseover="hoverStars(5)" onmouseout="resetStars()"></i>
            </div>
        </div>

        <!-- Text Input for Feedback -->
        <div class="mb-3">
            <label for="reviewText" class="form-label"><strong>Your Feedback:</strong></label>
            <textarea class="form-control" id="reviewText" rows="4"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>

<!-- JavaScript to handle the star rating functionality -->
<script>
    let selectedRating = 0; // Holds the selected rating value

    // Handle star hover
    function hoverStars(star) {
        for (let i = 1; i <= 5; i++) {
            document.getElementById("starr" + i).style.color = i <= star ? "#A68868" : "#FFF"; // Gold for hover, white for remaining
        }
    }

    // Handle star click (rating selection)
    function rate(star) {
        selectedRating = star;
        for (let i = 1; i <= 5; i++) {
            document.getElementById("starr" + i).style.color = i <= star ? "#A68868" : "#FFF"; // Gold for selected, white for unselected
        }
    }

    // Reset stars after hovering if no rating is selected
    function resetStars() {
        for (let i = 1; i <= 5; i++) {
            document.getElementById("starr" + i).style.color = i <= selectedRating ? "#A68868" : "#FFF"; // Keep selected stars gold, others white
        }
    }
</script>

<!-- Include FontAwesome for the stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Additional CSS for spacing and star styling -->
<style>
    .rating-stars1 i {
        font-size: 2rem;    /* Increase the size of the stars */
        color: #FFF;        /* Default color is white */
        cursor: pointer;
        transition: color 0.3s ease; /* Smooth color transition */
    }

    .rating-stars1 i:hover {
        color: #A68868;     /* Gold color on hover */
    }
</style>
    <!-- Related Products -->
    <div class="row related-products">
        <h4>Related Products</h4>
        <?php foreach ($related_products as $related_product): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $related_product['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $related_product['title']; ?></h5>
                        <p class="card-text"><?php echo number_format($related_product['price'], 2); ?> LE</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>