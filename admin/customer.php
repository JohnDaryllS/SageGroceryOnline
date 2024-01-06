<?php

include('header.php');

$customers = $db->query("SELECT * FROM users WHERE usertype = 'user'");

?>

<div class="container">
    <div class="row">
        <h3><b>Customer</b></h3>
        <table class="table table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Account Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($customer = $customers->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $customer['username'] ?></td>
                    <td><?php echo $customer['firstname'] ?> <?php echo $customer['lastname'] ?></td>
                    <td><?php echo $customer['phone'] ?></td>
                    <td><?php echo $customer['city'] ?></td>
                    <td><?php echo $customer['status'] ?></td>
                    <td>
                        <a class="btn btn-success" href="customer-view.php?id=<?php echo $customer['id'];?>">View</a>
                        <a href="edit-customer.php" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="../directories/product-action.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Create Product</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="name" class="fw-bold">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="quantity" class="fw-bold">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="uprice" class="fw-bold">Unit Price</label>
                            <input type="number" class="form-control" id="uprice" name="uprice" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="uom" class="fw-bold">Unit of Measurement</label>
                            <input type="text" class="form-control" id="uom" name="uom" placeholder="Enter Unit of Measurement" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>