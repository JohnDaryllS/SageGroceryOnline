<?php
session_start();
include('dbcontroller.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $uom = $_POST['uom'];
    $img = $_POST['img'];

    $target_dir = "../assets/product-images/";
    $fileName = basename($_FILES["img"]["name"]);

    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $targetFilePath = $target_dir . $fileName;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
                $sql = "INSERT INTO tblproduct (name,price,quantity,uom,image) VALUES ('$name','$price','$quantity','$uom','product-images/$fileName')";
                $query_run = mysqli_query($db, $query);

                if ($query_run) {
                    header('Location: ../admin/product.php');
                } else {
                    echo "<script>alert('Could Not Save Product Details');</script>";
                    header('Location: ../admin/customerorder.php');
                }
            }
        } else {
            echo "<script>alert('Could Not Save Product Details');</script>";
            header('Location: ../admin/customer.php');
        }
    }
}
