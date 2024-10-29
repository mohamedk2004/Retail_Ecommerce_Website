<?php
include '../classes/user_class.php';

// PHP Logic for validation
$firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $termsError = "";
$firstName = $lastName = $email = $password = $confirmPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // (Validation code remains the same)
    ...
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
    <style>
    .password-toggle {
        cursor: pointer;
        position: relative;
        top: -25px;
        left: 5px;
    }
    </style>
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
                    <div class="input-group">
                        <input type="password"
                            class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>"
                            id="password" name="password" placeholder="Enter password here" required>
                        <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                            👁️
                        </span>
                    </div>
                    <div class="invalid-feedback"><?php echo $passwordError; ?></div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password"
                            class="form-control <?php echo (!empty($confirmPasswordError)) ? 'is-invalid' : ''; ?>"
                            id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required>
                        <span class="input-group-text password-toggle" onclick="togglePassword('confirmPassword')">
                            👁️
                        </span>
                    </div>
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
    <script>
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
    }
    </script>
</body>

</html>