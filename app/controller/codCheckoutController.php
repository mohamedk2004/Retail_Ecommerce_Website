<?php
// Controller: Handles user input and application logic for cod_checkout

session_start();
require_once 'CodCheckoutModel.php';
require_once 'CodCheckoutView.php';

$model = new CodCheckoutModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate input
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $model->validateInput($name, $email, $address);

        // Process checkout (simplified for demonstration)
        // In a real-world scenario, this could involve saving to a database or sending an email
        renderCodCheckoutSuccess();
    } catch (Exception $e) {
        // Handle validation errors
        renderCodCheckoutError($e->getMessage());
    }
} else {
    // Show the cod_checkout form
    renderCodCheckoutForm();
}
?>