<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .promo-box {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .promo-box img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .checkout-btn {
            width: 100%;
            padding: 10px 0;
            font-size: 18px;
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .checkout-btn:hover {
            background-color: var(--secondary-color);
            color: var(--text-light);
        }

        .carousel {
            height: 500px;
            overflow: hidden;
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="/Retail_Ecommerce_Website-1/public/imgs/t.jpg" class="d-block w-100" alt="First Slide">

            </div>
            <div class="carousel-item">
            <img src="/Retail_Ecommerce_Website-1/public/imgs/k.jpg" class="d-block w-100" alt="First Slide">
            </div>
            <div class="carousel-item">
            <img src="/Retail_Ecommerce_Website-1/public/imgs/t.jpg" class="d-block w-100" alt="First Slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Promotions Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="promo-box">
                <img src="/Retail_Ecommerce_Website-1/public/imgs/mdesign_bottle0.8_dimensions.png   
" class="d-block w-100" alt="First Slide">
                <h5>Extra 10% off</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="promo-box">
                <img src="/Retail_Ecommerce_Website-1/public/imgs/a.png   
                " class="d-block w-100" alt="First Slide">
                    <h5>Shop like a boss</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="promo-box">
                    <img src="/Retail_Ecommerce_Website-1/public/imgs/vvv.png " alt="Promo 3">
                    <h5>Buy 5 Get 5% off</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="promo-box">
                    <img src="/Retail_Ecommerce_Website-1/public/imgs/l.png " alt="Promo 4">
                    <h5>Last Chance</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <!-- Quick Links Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">About Us</a></li>
                        <li><a href="#" class="text-dark">Privacy Policy</a></li>
                        <li><a href="#" class="text-dark">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Contact Information Section -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <h5 class="text-uppercase">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope"></i> info@yourwebsite.com</li>
                        <li><i class="bi bi-phone"></i> +123 456 789</li>
                        <li><i class="bi bi-geo-alt"></i> 123 Your Street, City, Country</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: #A4B5C4;">
            &copy; 2024 Your Website Name
        </div>
    </footer>

    

</html>
