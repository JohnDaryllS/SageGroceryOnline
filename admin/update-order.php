<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('customerorder.php');

    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    $update_query = "UPDATE user_order SET status = '$new_status' WHERE id = $order_id";
    
    if ($db->query($update_query) === TRUE) {
        $db->close();
        exit();
    }
}
?>
