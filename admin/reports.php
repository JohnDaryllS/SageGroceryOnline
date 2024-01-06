<?php 

include('header.php'); 

$orders = $db->query(
    "SELECT *  
    FROM user_order, item_order
    WHERE user_order.id = item_order.order_id"
);


$items = $db->query("SELECT * FROM tblproduct");

?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h3><b>Customer Order List</b></h3>
                <div class="d-flex justify-content-end">
                </div>
                <table class="table table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($order = $orders->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $order["order_id"] ?></td>
                            <td><?php echo $order["firstname"] ?> <?php echo $order["lastname"] ?></td>
                            <td><?php echo $order["phone"] ?></td>
                            <td><?php echo $order["city"] ?></td>
                            <td><?php echo $order["status"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <h3><b>Product List</b></h3>
                <div class="d-flex justify-content-end">
                </div>
                <table class="table table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Code</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($item = $items->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $item["name"] ?></td>
                            <td><?php echo $item["code"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>