<?php
// Start session
session_start();

// Sample user data from session or database (replace this with your actual data)
$userData = [
    'firstName' => $_SESSION['firstName'] ?? 'John',
    'lastName' => $_SESSION['lastName'] ?? 'Doe',
    'email' => $_SESSION['email'] ?? 'johndoe@example.com',
    'address' => $_SESSION['address'] ?? '123 Main St, Anytown, USA'
];

// Sample order data (replace with actual data from database)
$orderHistory = [
    ['orderId' => '001', 'date' => '2024-10-20', 'status' => 'Delivered', 'total' => '$150.00'],
    ['orderId' => '002', 'date' => '2024-10-10', 'status' => 'Shipped', 'total' => '$85.00'],
    ['orderId' => '003', 'date' => '2024-09-25', 'status' => 'Canceled', 'total' => '$60.00']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #071739;
            --secondary-color: #4b6382;
            --accent-color-1: #A68868;
            --accent-color-2: #E3C39D;
            --bg-color-light: #CDD5DB;
            --bg-color-secondary: #A4B5C4;
            --text-light: white;
            --text-dark: #071739;
            --danger-color: #e74c3c;
        }
        body {
            background-color: var(--bg-color-light);
            color: var(--text-dark);
        }
        .profile-container {
            max-width: 800px;
            margin-top: 2rem;
        }
        .card-header {
            background-color: var(--primary-color)!important;
            color: var(--text-light)!important;
            font-weight: bold;
        }
        .profile-card, .order-card {
            background-color: var(--bg-color-secondary);
            border-radius: 8px!important;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1)!important;
            margin-bottom: 1.5rem;
        }
        .order-table th {
            background-color: var(--secondary-color);
            color: var(--text-light);
        }
        .order-table tbody tr {
            color: var(--text-dark);
        }
        .order-table tbody tr:nth-child(even) {
            background-color: var(--bg-color-light);
        }
        .btn-edit-profile {
            background-color: var(--accent-color-1) !important;
            color: var(--text-light) !important;
            border: none !important;
        }
        .btn-edit-profile:hover {
            background-color: var(--accent-color-2) !important;
        }
        .btn-remove-account {
            background-color: var(--danger-color) !important;
            color: var(--text-light) !important;
            border: none !important;
        }
        .btn-remove-account:hover {
            background-color: darkred !important;
        }
        .greeting {
            font-size: 1.6rem!important;
            font-weight: 600!important;
            color: var(--primary-color) !important;
            margin-bottom: 1rem!important;
        }
    </style>
</head>
<body>
<?php require "./components/navbar.php"; ?>
<div class="container profile-container">
    <!-- Greeting -->
    <div class="greeting">
        Hello, <?= htmlspecialchars($userData['firstName']); ?>!
    </div>

    <!-- User Details Card -->
    <div class="card profile-card">
        <div class="card-header">Your Details</div>
        <div class="card-body">
            <p><strong>First Name:</strong> <?= htmlspecialchars($userData['firstName']); ?></p>
            <p><strong>Last Name:</strong> <?= htmlspecialchars($userData['lastName']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']); ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($userData['address']); ?></p>
            <a href="edituserprofile.php" class="btn btn-edit-profile mt-3">Edit Profile</a>
            <a href="remove_account.php" class="btn btn-remove-account mt-3 ms-2">Remove Account</a>
        </div>
    </div>

    <!-- Order History Card -->
    <div class="card order-card">
        <div class="card-header">Order History</div>
        <div class="card-body p-0">
            <table class="table order-table m-0">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderHistory as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['orderId']); ?></td>
                            <td><?= htmlspecialchars($order['date']); ?></td>
                            <td><?= htmlspecialchars($order['status']); ?></td>
                            <td><?= htmlspecialchars($order['total']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>