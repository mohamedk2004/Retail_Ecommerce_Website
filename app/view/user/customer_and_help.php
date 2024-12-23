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

        .form-section,
        .faq-section {
            padding: 40px 20px;
        }

        .faq-category {
            margin-bottom: 30px;
        }

        .faq-category h5 {
            margin-bottom: 15px;
        }

        .feedback-message {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Customer Support & Help Center</h1>
            <p>We are here to help! Contact us or find answers to your questions below.</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="form-section">
        <div class="container">
            <!-- Feedback Message -->
            <?php
           if (isset($_GET['message'])) {
            $type = $_GET['type'] ?? 'info';
            $color = $type === 'success' ? 'green' : 'red';
            echo "<p style='color: $color;'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        
            ?>

<form action="http://localhost/Retail_Ecommerce_Website-1/app/controller/ContactController.php" method="POST">
    <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <!-- Shipping Category -->
                <div class="col-md-4 faq-category">
                    <h5>Shipping</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">How long does shipping take?</a></li>
                        <li><a href="#" class="text-dark">Can I track my order?</a></li>
                        <li><a href="#" class="text-dark">Do you offer international shipping?</a></li>
                    </ul>
                </div>

                <!-- Returns Category -->
                <div class="col-md-4 faq-category">
                    <h5>Returns</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">What is your return policy?</a></li>
                        <li><a href="#" class="text-dark">How do I return an item?</a></li>
                        <li><a href="#" class="text-dark">When will I get my refund?</a></li>
                    </ul>
                </div>

                <!-- Orders Category -->
                <div class="col-md-4 faq-category">
                    <h5>Orders</h5>
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
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
    </footer>
</body>

</html>
