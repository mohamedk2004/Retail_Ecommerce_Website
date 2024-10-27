<?php
include './classes/user_class.php';

/// PHP Logic for validation
$firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $termsError = "";
$firstName = $lastName = $email = $password = $confirmPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //front-end validation 
    // Validate first name
    if (empty($_POST["firstName"])) {
        $firstNameError = "Please enter your first name.";
        echo 'NO FIRSTNAME entered.';
    } else {
        $firstName = $_POST["firstName"];
        echo 'FIRSTNAME posted SUCCESSFULLY';
    }

    // Validate last name
    if (empty($_POST["lastName"])) {
        $lastNameError = "Please enter your last name.";
        echo 'NO LASTNAME entered.';
    } else {
        $lastName = $_POST["lastName"];
        echo 'LASTNAME posted SUCCESSFULLY';
    }

    // Check if email is valid
    if (empty($_POST["email"])) {
        $emailError = "Please enter your email.";
        echo 'NO EMAIL entered';
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        echo 'INCORRECT EMAIL FORMAT';
    } else {
        $email = $_POST["email"];
        echo 'EMAIL posted SUCCESSFULLY';
    }

    // Check if password is at least 8 characters
    if (empty($_POST["password"])) {
        $passwordError = "Please enter your password.";
        echo 'NO PASSWORD entered';
    } elseif (strlen($_POST["password"]) < 8) {
        $passwordError = "Password must be at least 8 characters.";
        echo 'INCORRECT PASSWORD FORMAT';
    } else {
        $password = $_POST["password"];
        echo 'PASSWORD posted SUCCESSFULLY';
    }

    // Check if confirm password matches password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordError = "Please confirm your password.";
        echo 'NO COMFIRMPASSWORD entered';
    } elseif ($_POST["confirmPassword"] != $password) {
        $confirmPasswordError = "Passwords do not match.";
        echo 'INCORRECT COMFIRMPASSWORD MATCH';
    } else {
        $confirmPassword = $_POST["confirmPassword"];
        echo 'COMFIRMPASSWORD posted SUCCESSFULLY';
    }

    // Check if terms checkbox is checked
    if (!isset($_POST["terms"])) {
        $termsError = "You must agree to the terms and conditions.";
        echo 'TERMS UNCHECKED'; 
    } else {
        echo 'TERMS CHECKED SUCCESSFULLY';
    }

    // Only attempt to sign up if there are no errors
    if (empty($firstNameError) && empty($lastNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError) && empty($termsError)) {
        if (User::signUp($firstName, $lastName, $email, $password)) {
            // header("Location: http://localhost/Retail_Ecommerce_Website/registration/login_page.php");
            echo "All fields validated, attempting signup...";
        } else {
            $emailError = "Email already exists."; // Add an error if sign up fails
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
    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration_styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Top bar -->
    <div class="container-fluid registration-navbar text-center registration-navbar">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- Sign-up form container -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%; min-height: 650px;">
            <h2 class="text-center mb-4">Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
                <div class="row">
                    <div class="mb-3 col-md-6" style="padding-right: 10px;">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($firstNameError)) ? 'is-invalid' : ''; ?>"
                            id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>"
                            required>
                        <div class="invalid-feedback">
                            <?php echo (!empty($firstNameError)) ? $firstNameError : '&nbsp;'; ?></div>
                    </div>
                    <div class="mb-3 col-md-6" style="padding-left: 10px;">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($lastNameError)) ? 'is-invalid' : ''; ?>"
                            id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>"
                            required>
                        <div class="invalid-feedback">
                            <?php echo (!empty($lastNameError)) ? $lastNameError : '&nbsp;'; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>"
                        id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required>
                    <div class="invalid-feedback"><?php echo (!empty($emailError)) ? $emailError : '&nbsp;'; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" id="password"
                        name="password" placeholder="Enter password here" required>
                    <div class="invalid-feedback"><?php echo (!empty($passwordError)) ? $passwordError : '&nbsp;'; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($confirmPasswordError)) ? 'is-invalid' : ''; ?>"
                        id="confirmPassword" name="confirmPassword" placeholder="Re-enter password" required>
                    <div class="invalid-feedback">
                        <?php echo (!empty($confirmPasswordError)) ? $confirmPasswordError : '&nbsp;'; ?></div>
                </div>

                <!-- Checkbox for terms and conditions -->
                <div class="mb-3 form-check">
                    <input type="checkbox"
                        class="form-check-input <?php echo (!empty($termsError)) ? 'is-invalid' : ''; ?>" id="terms"
                        name="terms">
                    <label class="form-check-label" for="terms">I agree to the <a href="#" data-bs-toggle="modal"
                            data-bs-target="#termsModal">Terms and Conditions</a></label>
                    <div class="invalid-feedback d-block"><?php echo (!empty($termsError)) ? $termsError : '&nbsp;'; ?>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="submit-btn">Sign Up</button>
                </div>
            </form>

            <!-- Log in link -->
            <div class="text-center mt-4">
                <p>Already have an account? <a href="login_page.php" class="link">Log in</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="registration-footer mt-auto py-3">
        <div class="container text-center">
            <span class="">Copyright @ 2024 CompanyName</span>
        </div>
    </footer>

    <!-- Terms and Conditions Modal -->
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
                        times. Failure to do so constitutes a breach of the Terms, which may result in the immediate
                        termination of your account.</p>

                    <p><strong>3. Use of Services</strong></p>
                    <p>You agree to use our services in a manner consistent with all applicable laws and regulations.
                        You must not use our website for any illegal or unauthorized purpose, including but not limited
                        to:</p>
                    <ul>
                        <li>Impersonating any person or entity</li>
                        <li>Infringing on the intellectual property of others</li>
                        <li>Posting false or misleading information</li>
                    </ul>

                    <p><strong>4. Limitation of Liability</strong></p>
                    <p>To the fullest extent permitted by law, we are not liable for any direct, indirect, incidental,
                        consequential, or punitive damages arising from your use of our services.</p>

                    <p><strong>5. Changes to Terms</strong></p>
                    <p>We reserve the right to modify these Terms at any time. We will notify you of any changes by
                        posting the new Terms on this page. You are advised to review these Terms periodically for any
                        changes.</p>
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