<?php
// Start session
session_start();
require '../classes/user_class.php';  // Make sure User class has a deleteAccount method

// Check if the user is logged in
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

// Process account deletion upon form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['ID'];

    // Call deleteAccount function to remove the user from the database
    $deleteSuccess = User::deleteAccount($userId);

    if ($deleteSuccess) {
        // Clear session and redirect to goodbye page
        session_unset();
        session_destroy();
        // header("Location: goodbye.php");
        // exit();
        echo "Account deleted successfully. You will be redirected to the home page page in a few seconds.";
        header("refresh: 5; url=home_page.php");
    } else {
        $error = "Failed to delete the account. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --danger-color: #e74c3c;
            --text-light: white;
            --text-dark: #071739;
        }
        body {
            background-color: #f8f9fa;
            color: var(--text-dark);
        }
        .remove-account-container {
            max-width: 500px;
            margin-top: 3rem;
            text-align: center;
        }
        .btn-confirm-remove {
            background-color: var(--danger-color) !important;
            color: var(--text-light) !important;
            border: none !important;
        }
        .btn-confirm-remove:hover {
            background-color: darkred !important;
        }
        .btn-cancel {
            background-color: #6c757d !important;
            color: var(--text-light) !important;
            border: none !important;
        }
        .btn-cancel:hover {
            background-color: #5a6268 !important;
        }
        .alert-danger {
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container remove-account-container">
    <h1>Confirm Account Removal</h1>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <button type="submit" class="btn btn-confirm-remove mt-3">Yes, Delete My Account</button>
        <a href="userprofile.php" class="btn btn-cancel mt-3 ms-2">Cancel</a>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
