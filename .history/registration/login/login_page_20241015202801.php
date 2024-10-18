<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </title>
    <!-- import bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- import external css -->
    <link rel="stylesheet" href="login_page_styles.css">

</head>

<body>
    <!-- topbar -->
    <div class="container-fluid registration-navbar text-center">
        <h2 class="registration-navbar-logo">LOGO</h2>
        <h6 class="registration-navbar-slogan">Choose Your Products</h6>
    </div>

    <!-- form -->
    <h3 class="text-center mb-3">Login</h3>
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email here">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password:</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</body>

</html>