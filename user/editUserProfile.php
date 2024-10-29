<?php
session_start();
require '../classes/user_class.php';
// Simulated user data (replace with your database retrieval logic)
$userData = [
    'firstName' => $_SESSION['firstName'] ?? 'John',
    'lastName' => $_SESSION['lastName'] ?? 'Doe',
    'email' => $_SESSION['email'] ?? 'johndoe@example.com',
    'password' => $_SESSION['password'] ?? 'currentpassword' // In production, store hashed passwords!
];
// $showSuccessMessage = isset($_SESSION['updateSuccess']);
// if ($showSuccessMessage) {
//     unset($_SESSION['updateSuccess']);  // Clear the success message after use
// }

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $email = htmlspecialchars(trim($_POST['email']));
    // $currentPassword = trim($_POST['currentPassword']);
    // $newPassword = trim($_POST['newPassword']);
    // $confirmNewPassword = trim($_POST['confirmNewPassword']);

    // $sql="update users set firstname='$firstName', lastname='$lastName', email='$email', password='$pass'"
    // Update the session or database
    // $_SESSION['firstName'] = $firstName;
    // $_SESSION['lastName'] = $lastName;
    // $_SESSION['email'] = $email;

    // Validate password change
    // if (!empty($currentPassword) && !empty($newPassword) && !empty($confirmNewPassword))
    // {
    //     if ($currentPassword === $userData['password']) {
    //         if ($newPassword === $confirmNewPassword) {
    //             $result=User::editProfile($_SESSION['ID'],$firstName,$lastName,$email,$newPassword);
    //             $passwordChangeSuccess = "Password successfully updated!";
    //         } else {
    //             $passwordError = "New passwords do not match.";
    //         }
    //     } else {
    //         $passwordError = "Current password is incorrect.";
    //     }
    // }
    // else
    $result=User::editProfile($_SESSION['ID'],$firstName,$lastName,$email);
    if($result)
    {
    // header("Location: viewuserprofile.php");
    echo "User profile updated";
    }
    else{
            echo "Failed to update profile";
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['email'] = $email;
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #071739;
            --secondary-color: #4b6382;
            --accent-color-1: #A68868;
            --accent-color-2: #E3C39D;
            --bg-color-light: #CDD5DB;
            --text-light: white;
            --text-dark: #071739;
            --danger-color: #e74c3c;
        }
        body {
            background-color: var(--bg-color-light);
            color: var(--text-dark);
        }
        .edit-profile-container {
            max-width: 600px;
            margin-top: 2rem!important;
        }
        .card-header {
            background-color: var(--primary-color) !important;
            color: var(--text-light)!important;
        }
        .btn-save {
            background-color: var(--accent-color-1)!important;
            color: var(--text-light)!important;
            border: none !important;
        }
        .btn-save:hover {
            background-color: var(--accent-color-2)!important;
        }
        .btn-cancel {
            background-color: var(--danger-color)!important;
            color: var(--text-light)!important;
            border: none!important;
        }
        .btn-cancel:hover {
            background-color: darkred!important;
        }
        .text-danger, .text-success {
            font-size: 0.9rem!important;
            font-weight: 500!important;
        }
    </style>
</head>
<body>
<?php require "./components/navbar.php"; ?>

<div class="container edit-profile-container">
    <div class="card">
        <div class="card-header text-center">
            Edit Profile
        </div>
        <div class="card-body">
            <form action="edituserprofile.php" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($userData['firstName']); ?>" >
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($userData['lastName']); ?>" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userData['email']); ?>" >
                </div>

                <!-- Change Password Section -->
                <div class="card mt-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword">
                        </div>

                        
                    </div>
                </div>

                <button type="submit" class="btn btn-save mt-3">Save Changes</button>
                
                <a href="viewuserprofile.php" class="btn btn-cancel mt-3 ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Check URL parameters for ?update=success
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('update') && urlParams.get('update') === 'success') {
        alert('User profile updated successfully!');
        // Remove the parameter from the URL without reloading the page
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>
</body>
</html>