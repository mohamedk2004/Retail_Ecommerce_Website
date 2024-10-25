<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support & Help Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .hero-section {
        background: linear-gradient(to right, #A4B5C4, #F5F5F5);
        padding: 50px 0;
        text-align: center;
        color: #fff;
    }

    .hero-section h1 {
        font-size: 3rem;
    }

    .form-section {
        padding: 40px 20px;
    }

    .faq-section {
        padding: 40px 20px;
    }

    .faq-category {
        margin-bottom: 30px;
    }

    .faq-category h5 {
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php require "/components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Customer Support & Help Center</h1>
            <p>We are here to help! Contact us or find answers to your questions below.</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="form-section bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="submit_contact.php" method="POST" class="p-4 shadow-sm rounded bg-white">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Center Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="text-center mb-5">Help Center</h2>

            <!-- FAQ Search Bar -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <form class="d-flex">
                        <input class="form-control rounded-pill" type="search" placeholder="Search for answers..."
                            aria-label="Search">
                        <button class="btn btn-outline-primary rounded-pill ms-2" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="row">
                <!-- Shipping Category -->
                <div class="col-md-4 faq-category">
                    <h5><i class="bi bi-box-seam"></i> Shipping</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">How long does shipping take?</a></li>
                        <li><a href="#" class="text-dark">Can I track my order?</a></li>
                        <li><a href="#" class="text-dark">Do you offer international shipping?</a></li>
                    </ul>
                </div>

                <!-- Returns Category -->
                <div class="col-md-4 faq-category">
                    <h5><i class="bi bi-arrow-counterclockwise"></i> Returns</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">What is your return policy?</a></li>
                        <li><a href="#" class="text-dark">How do I return an item?</a></li>
                        <li><a href="#" class="text-dark">When will I get my refund?</a></li>
                    </ul>
                </div>

                <!-- Orders Category -->
                <div class="col-md-4 faq-category">
                    <h5><i class="bi bi-cart"></i> Orders</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">How do I track my order?</a></li>
                        <li><a href="#" class="text-dark">How do I modify my order?</a></li>
                        <li><a href="#" class="text-dark">Can I cancel my order?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center p-4" style="background-color: #A4B5C4;">
        <p>© 2024 Your Website Name. All rights reserved.</p>
    </footer>

</body>

</html>