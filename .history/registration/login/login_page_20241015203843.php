<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Import external CSS -->
    <link rel="stylesheet" href="login_page_styles.css">
</head>

<body>
    <!-- Topbar -->
    <div class="container-fluid registration-navbar text-center">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- Login form -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Login</h3>
        <form action="process_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email here"
                    required>
                <!-- Empty div for validation -->
                <div class=""></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter password here" required>
                <!-- Empty div for validation -->
                <div class=""></div>
            </div>

            <!-- Checkbox for terms and conditions -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">I agree to the <a href="terms_and_conditions.php">Terms and
                        Conditions</a></label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Sign up link -->
        <div class="text-center mt-4">
            <p>Don't have an account? <a href="registration_page.php" class="text-decoration-none">Sign up</a></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid registration-footer text-center">
        <h6 class="registration-footer">Copyright @ 2024 CompanyName.</h6>
    </div>
</body>

</html>