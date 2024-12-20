<?php
session_start();

// Ensure the cart is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

// Enable error reporting to debug issues
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include PHPMailer
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input
    $name = htmlspecialchars($_POST['name']);
    $city = htmlspecialchars($_POST['city']);
    $address = htmlspecialchars($_POST['address']);
    $floor = htmlspecialchars($_POST['floor']);
    $phone = htmlspecialchars($_POST['phone']);

    if (empty($name) || empty($city) || empty($address) || empty($floor) || empty($phone)) {
        $error = "All fields are required.";
    } else {
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mohamed2202505@miuegypt.edu.eg'; // Replace with your Gmail email
            $mail->Password = 'vwbz uwwy icol njry'; // Replace with your Gmail App Password
            $mail->SMTPSecure = 'tls'; // Encryption type
            $mail->Port = 587; // SMTP port

            // Email headers
            $mail->setFrom('mohamed2202505@miuegypt.edu.eg', 'Your Business'); // Sender email and name
            $mail->addAddress('mido3072004@icloud.com'); // Replace with your recipient email

            // Email subject and body
            $mail->Subject = "New Cash on Delivery Order";
            $message = "You have a new Cash on Delivery order:\n\n";
            $message .= "Customer Details:\n";
            $message .= "Name: $name\n";
            $message .= "City: $city\n";
            $message .= "Address: $address\n";
            $message .= "Floor: $floor\n";
            $message .= "Phone: $phone\n\n";
            $message .= "Order Details:\n";

            foreach ($_SESSION['cart'] as $item) {
                $message .= "- " . $item['name'] . " x" . $item['quantity'] . " @ EGP " . number_format($item['price'], 2) . "\n";
            }

            $message .= "\nTotal Amount: EGP " . number_format(array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $_SESSION['cart'])), 2);

            $mail->Body = $message;

            // Send email
            if ($mail->send()) {
                unset($_SESSION['cart']); // Clear the cart
                $success = "Your order has been placed successfully! We will contact you shortly.";
            } else {
                $error = "Failed to send email.";
            }
        } catch (Exception $e) {
            $error = "Email could not be sent. Error: " . $mail->ErrorInfo;
        }
    }
}
?>

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
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 40px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 50px;
        }
        .btn-secondary {
            border-radius: 50px;
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
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="mb-4">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city" required>
            </div>
            <div class="mb-4">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter your full address" required></textarea>
            </div>
            <div class="mb-4">
                <label for="floor" class="form-label">Floor Number</label>
                <input type="text" id="floor" name="floor" class="form-control" placeholder="Enter your floor number" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-100">Place Order</button>
                <a href="checkout.php" class="btn btn-secondary ms-3 w-100">Back to Checkout</a>
            </div>
        </form>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>