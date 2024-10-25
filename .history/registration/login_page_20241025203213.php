<?php
session_start();


// PHP Logic for login validation
include_once "includes/dbh.inc.php";
$emailError = $passwordError = $termsError = $email = $password = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        //grab data from user and see if it exists in database
        $email=$_POST["Email"];
    $password=$_POST["Password"];

    $sql="Select * from users where Email ='$Email' and Password='$Password'";
    $result = mysqli_query($conn,$sql);

    if($row=mysqli_fetch_array($result))	{
    $_SESSION["ID"]=$row[0];
    $_SESSION["FName"]=$row["FirstName"];
    $_SESSION["LName"]=$row["LastName"];
    $_SESSION["Email"]=$row["Email"];
    $_SESSION["Password"]=$row["Password"];
    $_SESSION["Hobby"]=$row["Hobby"];
    header("Location:index.php?login=success");
    }
    // Check if this is a forgot password submission
    if (isset($_POST['forgot_password_submit'])) {
        // Handle forgot password functionality
        $forgotEmail = $_POST['forgot_email'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
    }
        
        // Validate email
        if (empty($forgotEmail) || !filter_var($forgotEmail, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Please enter a valid email address.";
        } else {
            // Check if passwords match
            if ($newPassword != $confirmPassword) {
                $passwordError = "Passwords do not match.";
            } elseif (strlen($newPassword) < 8) {
                $passwordError = "Password must be at least 8 characters.";
            } else {
                // Assume function to update password
                // update_user_password($forgotEmail, $newPassword);

                // For demonstration purposes, we'll assume the password is updated
                $passwordUpdated = true;

                if ($passwordUpdated) {
                    echo "<script>alert('Password updated successfully!');</script>";
                } else {
                    $emailError = "Failed to update password. Please try again.";
                }
            }
        }
    } else {
        // Handle login form
        // Check if email is valid
        if (empty($_POST["email"])) {
            $emailError = "Please enter your email.";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format.";
        } else {
            $email = $_POST["email"];
        }

        // Check if password is at least 8 characters
        if (empty($_POST["password"])) {
            $passwordError = "Please enter your password.";
        } elseif (strlen($_POST["password"]) < 8) {
            $passwordError = "Password must be at least 8 characters.";
        } else {
            $password = $_POST["password"];
        }

        // // If no errors, assume login is successful
        // if (empty($emailError) && empty($passwordError)) {
        //     $_SESSION['email'] = $email;
        //     echo "<script>alert('Login successful!');</script>";
        //     // Redirect to dashboard or homepage
        // }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Import Bootstrap -->
    <link rel="stylesheet" href="registration_styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Top bar -->
    <div class="container-fluid registration-navbar text-center">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- Login form container -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%;">
            <div class="d-flex flex-column justify-content-center">
                <h2 class="text-center mb-4">Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="email"
                            class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>" id="email"
                            name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required>
                        <div class="invalid-feedback">
                            <?php echo (!empty($emailError)) ? $emailError : '&nbsp;'; ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password"
                            class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>"
                            id="password" name="password" placeholder="Enter password here" required>
                        <div class="invalid-feedback">
                            <?php echo (!empty($passwordError)) ? $passwordError : '&nbsp;'; ?>
                        </div>
                    </div>

                    <!-- Forgot Password link triggers modal -->
                    <div class="mb-4 text-end">
                        <a href="#" class="link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot
                            Password?</a>
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid gap-2 mt-4 ">
                        <button type="submit" class="submit-btn">Login</button>
                    </div>
                </form>

                <!-- Sign up link -->
                <div class="text-center mt-4">
                    <p>Don't have an account? <a href="sign_up_page.php" class="link">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="mb-3">
                            <label for="forgot_email" class="form-label">Email address:</label>
                            <input type="email" class="form-control" id="forgot_email" name="forgot_email"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                placeholder="Enter new password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm new password" required>
                        </div>
                        <!-- Submit button for forgot password -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="submit-btn" name="forgot_password_submit">Update
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="registration-footer mt-auto py-3">
        <div class="container text-center">
            <span>Copyright @ 2024 CompanyName</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>