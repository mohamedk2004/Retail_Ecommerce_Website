<?php
    /// PHP Logic for validation
    $emailError = $passwordError = $termsError = "";
    $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Check if terms checkbox is checked
        if (!isset($_POST["terms"])) {
            $termsError = "You must agree to the terms and conditions.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration_styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Top bar -->
    <div class="container-fluid registration-navbar text-center">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- Login form container -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%; min-height: 550px;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
                <div class="mb-4">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>"
                        id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required>
                    <!-- Email validation feedback -->
                    <div class="invalid-feedback">
                        <?php echo (!empty($emailError)) ? $emailError : '&nbsp;'; ?>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" id="password"
                        name="password" placeholder="Enter password here" required>
                    <!-- Password validation feedback -->
                    <div class="invalid-feedback">
                        <?php echo (!empty($passwordError)) ? $passwordError : '&nbsp;'; ?>
                    </div>
                </div>

                <!-- Checkbox for terms and conditions -->
                <div class="mb-4 form-check">
                    <input type="checkbox"
                        class="form-check-input <?php echo (!empty($termsError)) ? 'is-invalid' : ''; ?>" id="terms"
                        name="terms">
                    <label class="form-check-label" for="terms">I agree to the <a href="terms_and_conditions.php">Terms
                            and Conditions</a></label>
                    <!-- Terms validation feedback -->
                    <div class="invalid-feedback d-block">
                        <?php echo (!empty($termsError)) ? $termsError : '&nbsp;'; ?>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <!-- Sign up link -->
            <div class="text-center mt-4">
                <p>Don't have an account? <a href="sign_up_page.php" class="text-decoration-none">Sign up</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="registration-footer mt-auto py-3">
        <div class="container text-center">
            <span class="">Copyright @ 2024 CompanyName</span>
        </div>
    </footer>


</body>

</html>