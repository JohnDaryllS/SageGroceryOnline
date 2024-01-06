<?php
session_start();
include('dbcontroller.php');

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zipcode'];

    $username = $_POST['firstname'] . $_POST['lastname'];

    $email_query = "SELECT * FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($db, $email_query);
    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: ../signup.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO users (username,email,password,usertype,firstname,lastname,phone,address,city,zipcode) VALUES ('$username','$email','$password','user','$firstname','$lastname','$phone','$address','$city','$zip')";
            $query_run = mysqli_query($db, $query);

            if ($query_run) {
                $_SESSION['status'] = "Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: ../login.php');
            } else {
                $_SESSION['status'] = "Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: ../signup.php');
            }
        } else {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: ../signup.php');
        }
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $query_run = mysqli_query($db, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if ($usertypes['usertype'] == "admin") {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

        $query = $db->query($sql);

        while ($row = $query->fetch_assoc()){

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
        }
        header('Location: ../admin/home.php');
    } else if ($usertypes['usertype'] == "user") {

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";

        $query = $db->query($sql);

        while ($row = $query->fetch_assoc()){

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
        }
        header('Location: ../user/home.php');
    } else {
        $_SESSION['status'] = "Username / Password is Invalid";
        header('Location: ../login.php');
    }
}

