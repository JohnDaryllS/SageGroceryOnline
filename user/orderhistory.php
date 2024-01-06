<?php 

include('header.php'); 

$items = $db->query(
    "SELECT *  
    FROM user_order
    WHERE user_order.user_id='$_SESSION[id]'");
?>
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-8 mb-2">
        <h1><b>My Order History</b></h1><br>
            <div class="card">
                <div class="card-body text-center">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Order ID</th>
                                <th>Order Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($item = $items->fetch_assoc()) { 
                            $dt = new \DateTime($item["orderdate"]); ?>
                            <tr>
                                <td><?php echo $dt->format('Y-m-d') ?></td>
                                <td><?php echo $item["id"] ?></td>
                                <td><?php echo $item["totalprice"] ?></td>
                                <td><?php echo $item["status"] ?></td>
                                <td>
                                    <a class="btn btn-primary form-control" href="order-details.php?id=<?php echo $item['id'];?>">View</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>