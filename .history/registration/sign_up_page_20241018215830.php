<?php
    /// PHP Logic for validation
    $firstNameError = $lastNameError = $emailError = $passwordError = $confirmPasswordError = $termsError = "";
    $firstName = $lastName = $email = $password = $confirmPassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if first name is valid
        if (empty($_POST["first_name"])) {
            $firstNameError = "Please enter your first name.";
        } else {
            $firstName = $_POST["first_name"];
        }

        // Check if last name is valid
        if (empty($_POST["last_name"])) {
            $lastNameError = "Please enter your last name.";
        } else {
            $lastName = $_POST["last_name"];
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

        // Check if confirm password matches
        if (empty($_POST["confirm_password"])) {
            $confirmPasswordError = "Please confirm your password.";
        } elseif ($_POST["password"] !== $_POST["confirm_password"]) {
            $confirmPasswordError = "Passwords do not match.";
        } else {
            $confirmPassword = $_POST["confirm_password"];
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
    <title>Sign Up Page</title>
    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./registration_styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Top bar -->
    <div class="container-fluid registration-navbar text-center registration-footer">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- Sign up form container -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card p-4 shadow-sm" style="max-width: 600px; width: 100%; min-height: 550px;">
            <h2 class="text-center mb-4">Sign Up</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
                <!-- First and Last Name Row -->
                <div class="row mb-4">
                    <div class="col-md-6 p">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($firstNameError)) ? 'is-invalid' : ''; ?>"
                            id="first_name" name="first_name" placeholder="Enter first name"
                            value="<?php echo $firstName; ?>" required>
                        <!-- First name validation feedback -->
                        <div class="invalid-feedback">
                            <?php echo (!empty($firstNameError)) ? $firstNameError : '&nbsp;'; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text"
                            class="form-control <?php echo (!empty($lastNameError)) ? 'is-invalid' : ''; ?>"
                            id="last_name" name="last_name" placeholder="Enter last name"
                            value="<?php echo $lastName; ?>" required>
                        <!-- Last name validation feedback -->
                        <div class="invalid-feedback">
                            <?php echo (!empty($lastNameError)) ? $lastNameError : '&nbsp;'; ?>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>"
                        id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required>
                    <!-- Email validation feedback -->
                    <div class="invalid-feedback">
                        <?php echo (!empty($emailError)) ? $emailError : '&nbsp;'; ?>
                    </div>
                </div>

                <!-- Password -->
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

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password"
                        class="form-control <?php echo (!empty($confirmPasswordError)) ? 'is-invalid' : ''; ?>"
                        id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
                    <!-- Confirm password validation feedback -->
                    <div class="invalid-feedback">
                        <?php echo (!empty($confirmPasswordError)) ? $confirmPasswordError : '&nbsp;'; ?>
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
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
            </form>

            <!-- Login link -->
            <div class="text-center mt-4">
                <p>Already have an account? <a href="login_page.php" class="text-decoration-none">Login</a></p>
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