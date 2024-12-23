<?php
// Define the root directory if not already defined
if (!defined('__ROOT__')) {
    define('__ROOT__', dirname(__FILE__) . '/');
}

// Debugging: Output the root directory path
var_dump(__ROOT__);

require_once('C:/xampp/htdocs/Retail_Ecommerce_Website-1/app/model/contact/ContactModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Instantiate the ContactModel and insert the message
    $contactModel = new ContactModel();
    $response = $contactModel->insertMessage($name, $email, $subject, $message);

    // Return response (You can redirect or display the response directly)
    echo $response;
} else {
    // If the request method is not POST, display an error
    echo "Invalid request method.";
}
