<?php
session_start();
require_once('../model/CodCheckoutModel.php');

class CodCheckoutController {
    public function handleRequest() {
        try {
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                throw new Exception("Your cart is empty.");
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = htmlspecialchars($_POST['name']);
                $city = htmlspecialchars($_POST['city']);
                $address = htmlspecialchars($_POST['address']);
                $floor = htmlspecialchars($_POST['floor']);
                $phone = htmlspecialchars($_POST['phone']);

                if (empty($name) || empty($city) || empty($address) || empty($floor) || empty($phone)) {
                    throw new Exception("All fields are required.");
                }

                $model = new CodCheckoutModel($_SESSION['cart']);
                $model->validateCart();
                $model->sendOrderEmail($name, $city, $address, $floor, $phone);
                include('../view/checkout_success.php');
            } else {
                include('../view/checkout_form.php');
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            include('../views/checkout_form.php');
        }
    }
}