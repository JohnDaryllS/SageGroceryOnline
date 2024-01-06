<?php 
session_start();
require_once '../action/dbcontroller.php';

$name = $db->query("SELECT * FROM users");


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sage Grocery Online</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="../assets/icons/logo.png" type="image/x-icon">

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="wrapper">
        <?php if (!isset($_SESSION['username'])) { ?>
            <div class="container-fluid header">
                <a href="../login.php" class="btn btn-primary">Log In</a>
                <a href="../signup.php" class="btn btn-success">Sign Up</a>
            </div>
            <?php } else { ?>
                <div class="container-fluid header">
                    <div class="row">
                        <div class="col-6">
                            <a <a href="../action/logout.php" class="btn btn-secondary">Log Out</a>
                        </div>
                        <div class="col-6 text-end">
                            <h5>Welcome <?php echo $_SESSION['username'];?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">Sage Grocery Online</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link" href="product.php">Manage Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customer.php">Manage Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customerorder.php">Customer Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reports.php">Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>