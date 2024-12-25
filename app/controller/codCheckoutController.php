<?php
require_once 'models/payments/codCheckoutModel.php';

class CodCheckoutController {
    private $model;

    public function __construct() {
        $this->model = new CodCheckoutModel();
    }

    public function displayForm() {
        try {
            $this->model->validateCart();
            include 'view/pages/user/cod_checkout_view.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include 'view/pages/user/cod_checkout_view.php';
        }
    }

    public function processForm() {
        try {
            $this->model->validateCart();

            // Validate user input
            $name = htmlspecialchars($_POST['name']);
            $city = htmlspecialchars($_POST['city']);
            $address = htmlspecialchars($_POST['address']);
            $floor = htmlspecialchars($_POST['floor']);
            $phone = htmlspecialchars($_POST['phone']);

            if (empty($name) || empty($city) || empty($address) || empty($floor) || empty($phone)) {
                throw new Exception("All fields are required.");
            }

            // Send order email
            $this->model->sendOrderEmail($name, $city, $address, $floor, $phone);
            $success = "Your order has been placed successfully! We will contact you shortly.";
            include 'views/user/cod_checkout_view.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include 'views/user/cod_checkout_view.php';
        }
    }
}
?>