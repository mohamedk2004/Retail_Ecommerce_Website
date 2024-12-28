<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CodCheckoutModel {
    private $cart;

    public function __construct($cart) {
        $this->cart = $cart;
    }

    public function validateCart() {
        if (empty($this->cart)) {
            throw new Exception("Your cart is empty.");
        }
    }

    public function calculateTotal() {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cart));
    }

    public function sendOrderEmail($name, $city, $address, $floor, $phone) {
        require '../../vendor/autoload.php';
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mohamed2202505@miuegypt.edu.eg';
        $mail->Password = 'vwbz uwwy icol njry';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('mohamed2202505@miuegypt.edu.eg', 'Your Business');
        $mail->addAddress('mido3072004@icloud.com');
        $mail->isHTML(true);
        $mail->Subject = "New Cash on Delivery Order";

        $message = "You have a new Cash on Delivery order:<br/>";
        $message .= "Customer Details:<br/>";
        $message .= "Name: $name<br/>";
        $message .= "City: $city<br/>";
        $message .= "Address: $address<br/>";
        $message .= "Floor: $floor<br/>";
        $message .= "Phone: $phone<br/><br/>";
        $message .= "Order Details:<br/>";

        foreach ($this->cart as $item) {
            $message .= "- " . $item['name'] . " x" . $item['quantity'] . " @ EGP " . number_format($item['price'], 2) . "<br/>";
        }

        $message .= "<br/>Total Amount: EGP " . number_format($this->calculateTotal(), 2);
        $mail->Body = $message;

        if (!$mail->send()) {
            throw new Exception("Email could not be sent. Error: " . $mail->ErrorInfo);
        }
        unset($_SESSION['cart']);
    }
}