<?php
include '../classes/user_class.php';

/// PHP Logic for validation
$firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $termsError = "";
$firstName = $lastName = $email = $password = $confirmPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate first name
    if (empty($_POST["firstName"])) {
        $firstNameError = "Please enter your first name.";
    } else {
        $firstName = $_POST["firstName"];
    }

    // Validate last name
    if (empty($_POST["lastName"])) {
        $lastNameError = "Please enter your last name.";
    } else {
        $lastName = $_POST["lastName"];
    }

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

    // Check if confirm password matches password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordError = "Please confirm your password.";
    } elseif ($_POST["confirmPassword"] != $password) {
        $confirmPasswordError = "Passwords do not match.";
    } else {
        $confirmPassword = $_POST["confirmPassword"];
    }

    // Check if terms checkbox is checked
    if (!isset($_POST["terms"])) {
        $termsError = "You must agree to the terms and conditions.";
    }

    // Only attempt to sign up if there are no errors
    if (empty($firstNameError) && empty($lastNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError) && empty($termsError)) {
        if (User::signUp($firstName, $lastName, $email, $password)) {
            header("Location: http://localhost/Retail_Ecommerce_Website/registration/login_page.php");
        } else {
            $emailError = "Email already exists.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration_styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid registration-navbar text-center">
        <h2 class="registration-navbar-logo">Eleva</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%; min-height: 650px;">
            <h2 class="text-center mb-4">Sign Up</h2>
            <form action="" method="POST" novalidate>
                <div class="row">
                    <div class="mb-3 col-md-6" style="padding-right: 10px;">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($firstNameError)) ? 'is-invalid' : ''; ?>"
                            id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>"
                            required>
                        <div class="invalid-feedback"><?php echo $firstNameError; ?></div>
                    </div>
                    <div class="mb-3 col-md-6" style="padding-left: 10px;">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($lastNameError)) ? 'is-invalid' : ''; ?>"
                            id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>"
                            required>
                        <div class="invalid-feedback"><?php echo $lastNameError; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>"
                        id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required>
                    <div class="invalid-feedback"><?php echo $emailError; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" id="password"
                        name="password" placeholder="Enter password here" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        Show
                    </button>
                    <div class="invalid-feedback"><?php echo $passwordError; ?></div>

                    <input type="password"
                        class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" id="password"
                        name="password" placeholder="Enter password here" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        Show
                    </button>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($confirmPasswordError)) ? 'is-invalid' : ''; ?>"
                        id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required>
                    <div class="invalid-feedback"><?php echo $confirmPasswordError; ?></div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox"
                        class="form-check-input <?php echo (!empty($termsError)) ? 'is-invalid' : ''; ?>" id="terms"
                        name="terms">
                    <label class="form-check-label" for="terms">I agree to the <a href="#" data-bs-toggle="modal"
                            data-bs-target="#termsModal">Terms and Conditions</a></label>
                    <div class="invalid-feedback d-block"><?php echo $termsError; ?></div>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="submit-btn">Sign Up</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p>Already have an account? <a href="login_page.php" class="link">Log in</a></p>
            </div>
        </div>
    </div>
    <footer class="registration-footer mt-auto py-3">
        <div class="container text-center">
            <span>Copyright © 2024 CompanyName</span>
        </div>
    </footer>
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                </div>
                <div class="modal-body">
                    <p><strong>1. Introduction</strong></p>
                    <p>Welcome to [Your Company Name]. By using our website, you agree to these Terms and Conditions,
                        and to our Privacy Policy.</p>
                    <p><strong>2. Account Registration</strong></p>
                    <p>When creating an account, you must provide accurate, complete, and current information at all
                        times.</p>
                    <p><strong>3. Use of Services</strong></p>
                    <p>You agree to use our services in a manner consistent with all applicable laws and regulations.
                    </p>
                    <ul>
                        <li>Impersonating any person or entity</li>
                        <li>Infringing on the intellectual property of others</li>
                        <li>Posting false or misleading information</li>
                    </ul>
                    <p><strong>4. Limitation of Liability</strong></p>
                    <p>To the fullest extent permitted by law, we are not liable for any damages arising from your use
                        of our services.</p>
                    <p><strong>5. Changes to Terms</strong></p>
                    <p>We reserve the right to modify these Terms at any time.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>