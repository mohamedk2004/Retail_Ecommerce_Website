<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CodCheckoutModel extends Model {
    public function __construct() {
        parent::__construct(); // Initialize the database connection via the parent class
        session_start();
    }

    /**
     * Ensure the cart is not empty.
     */
    public function validateCart() {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            throw new Exception("Your cart is empty.");
        }
    }

    /**
     * Calculate the total amount for the cart.
     */
    public function calculateCartTotal() {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart']));
    }

    /**
     * Save the Cash on Delivery order into the database.
     */
    public function saveOrderToDatabase($name, $city, $address, $floor, $phone) {
        $cartTotal = $this->calculateCartTotal();
        $paymentDate = date('Y-m-d H:i:s');
        $paymentMethod = "COD";

        // Prepare the order details for insertion
        $sql = "INSERT INTO payment (order_id, amount, payment_method, payment_date) VALUES 
                (NULL, '$cartTotal', '$paymentMethod', '$paymentDate')";
        if ($this->db->query($sql) === true) {
            return $this->db->insert_id; // Return the inserted order ID
        } else {
            throw new Exception("Error saving order to database: " . $this->db->error);
        }
    }

    /**
     * Send an order confirmation email.
     */
    public function sendOrderEmail($name, $city, $address, $floor, $phone) {
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mohamed2202505@miuegypt.edu.eg'; // Replace with your Gmail email
            $mail->Password = 'vwbz uwwy icol njry'; // Replace with your Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Email headers
            $mail->setFrom('mohamed2202505@miuegypt.edu.eg', 'Your Business');
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

            $message .= "\nTotal Amount: EGP " . number_format($this->calculateCartTotal(), 2);

            $mail->Body = $message;

            // Send email
            $mail->send();
            unset($_SESSION['cart']); // Clear the cart
            return true;
        } catch (Exception $e) {
            throw new Exception("Email could not be sent. Error: " . $mail->ErrorInfo);
        }
    }
}
?>