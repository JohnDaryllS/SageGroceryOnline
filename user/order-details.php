<?php

include('header.php');

$id = $_GET['id'];

$items = $db->query(
    "SELECT *  
    FROM user_order, item_order
    WHERE user_order.id='$id' and item_order.order_id='$id'"
);

?>

<div class="container mb-4">
    <?php while ($item = $items->fetch_assoc()) {
        $dt = new \DateTime($item["orderdate"]); ?>
        <div class="row">
            <h3><b>Order > > Order Details</b></h3>
            <h3 class="fw-bold text-primary"><?php echo $item["status"] ?></h3>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <p>Customer: <b><?php echo $item["firstname"] ?> <?php echo $item["lastname"] ?></b></p>
                <p>Address: <b><?php echo $item["address"] ?></b></p>
                <p>Phone Number: <b><?php echo $item["phone"] ?></b></p>
                <p>E-mail: <b><?php echo $item["email"] ?></b></p>
            </div>
            <div class="col-6">
                <p>Order ID: <b><?php echo $item["id"] ?></b></p>
                <p>Order Date: <b><?php echo $dt->format('Y-m-d') ?></b></p>
                <p>Order Total: <b><?php echo $item["totalprice"] ?></b></p>
            </div>
        </div>
        <div class="row">
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-responsive mt-2 text-center">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $names = explode(',', $item["item_name"]);
                            $quantities = explode(',', $item["quantity"]);
                            $prices = explode(',', $item["price"]);

                            foreach ($names as $key => $val) { ?>
                                <tr>
                                    <td><?php echo $val ?></td>
                                    <td><?php echo $quantities[$key] ?></td>
                                    <td><?php echo $prices[$key] ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="fw-bold">Total:</td>
                                <td><?php echo $item["totalquantity"] ?></td>
                                <td><strong><?php echo $item["totalprice"] ?></strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
<?php } ?>
<?php include('footer.php'); ?>