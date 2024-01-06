<?php
include('header.php');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_query = "DELETE FROM tblproduct WHERE id = $product_id";
    $delete_result = mysqli_query($db, $delete_query);

    if ($delete_result) {
        header('Location: product.php');
    } else {
        echo "<script>alert('Could Not Delete Product');</script>";
        header('Location: product.php');
    }
} else {
    echo "<script>alert('Invalid Product ID');</script>";
    header('Location: product.php');
}

include('footer.php');
?>
