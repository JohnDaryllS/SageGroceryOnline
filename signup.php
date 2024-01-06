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
</head>

<body>
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
        <div class="container mb-4">
            <div class="row d-flex justify-content-center mt-4">
                <div class="card col-lg-6" style="background-color: rgb(130, 193, 82, 0.5);">
                    <div class="card-body">
                        <form action="action/login_check.php" method="post">
                            <h3 class="text-center"><b>Create a Sage Grocery Account</b></h3>
                            <div class="form-group mt-2">
                                <label for="email" class="fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" placeholder="Enter email" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="password" class="fw-bold">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="confirmpassword" class="fw-bold">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                                    placeholder="Confirm Password" required>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mt-2">
                                        <label for="firstname" class="fw-bold">Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                            placeholder="First" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-2">
                                        <label for="lastname" class="fw-bold"></label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            placeholder="Last" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="phone" class="fw-bold">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address" class="fw-bold">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="city" class="fw-bold">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="City" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="zipcode" class="fw-bold">Zip Code</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                    placeholder="Zip Code" required>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="text-center mt-2">
                                        <button type="submit" name="register"
                                            class="btn btn-success form-control justify-content-center">Submit</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center mt-2">
                                        <button type="#" 
                                            class="btn btn-danger form-control justify-content-center">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <body class="d-flex flex-column min-vh-100">
        <footer class="mt-auto">
            <p>Developed by: JOHN DARYLL SAMPILINGAN</p>
        </footer>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>