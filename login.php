<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sage Grocery Online</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="assets/icons/logo.png" type="image/x-icon">

    <style>
        .container {
        padding-top: 120px;
}
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="wrapper">
        <div class="container-fluid header">
            <a href="login.php" class="btn btn-primary">Log In</a>
            <a href="signup.php" class="btn btn-success">Sign Up</a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sage Grocery Online</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="user/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/fruits.php">Fruits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/shopping-basket.php">Shopping Basket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/search.php">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/about.php">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="row d-flex justify-content-center mt-4">
                <div class="card col-lg-4" style="background-color: rgb(130, 193, 82, 0.5);">
                    <div class="card-body">
                        <form action="action/login_check.php" method="post">
                            <h3 class="text-center"><b>Login to your Account</b></h3>
                            <div class="form-group mt-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter email">
                            </div>
                            <div class="form-group mt-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary justify-content-center" name="login">Login</button>
                            </div>
                        </form>

                         <!-- Display alert for successful or unsuccessful login -->
                    <!-- Display alert for successful or unsuccessful login -->
                    <?php
                    if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
                        $status = $_SESSION['status'];
                        $status_code = $_SESSION['status_code'];

                        // Display alert based on status and status code
                        echo "<div class='alert alert-$status_code alert-dismissible fade show mt-3' role='alert'>
                                $status
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";

                        // Unset the session variables to clear the status after displaying the alert
                        unset($_SESSION['status']);
                        unset($_SESSION['status_code']);
                    }
                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-auto">
        <p>Developed by: JOHN DARYLL SAMPILINGAN</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>