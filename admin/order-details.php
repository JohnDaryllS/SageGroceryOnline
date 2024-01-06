<?php 
include('header.php'); 

$orders = $db->query(
    "SELECT *  
    FROM user_order, item_order
    WHERE user_order.id = item_order.order_id"
);
?>

<div class="container">
    <div class="row">
        <h3><b>Order</b></h3>
        <table class="table table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Order Date</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $orders->fetch_assoc()) { 
                    $dt = new \DateTime($order["orderdate"]);
                ?>
                    <tr>
                        <td><?php echo $dt->format('Y-m-d') ?></td>
                        <td><?php echo $order["order_id"] ?></td>
                        <td><?php echo $order["firstname"] ?> <?php echo $order["lastname"] ?></td>
                        <td><?php echo $order["phone"] ?></td>
                        <td><?php echo $order["city"] ?></td>
                        <td><?php echo $order["status"] ?></td>
                        <td>
                            <form action="update-order.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <select name="new_status" class="form-control">
                                    <option value="Pending">Pending</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
