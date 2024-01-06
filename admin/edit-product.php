<?php

include('header.php');

$id = $_GET['id'];

$fruits = $db->query("SELECT * FROM tblproduct WHERE id = '$id'");

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $uom = $_POST['uom'];

    $query = "UPDATE tblproduct SET price = '$price', quantity = '$quantity', uom = '$uom', name = '$name' WHERE id = '$id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        header('Location: ../admin/product.php');
    } else {
        header('Location: ../admin/home.php');
    }
}

?>

<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <?php while ($fruit = $fruits->fetch_assoc()) { ?>
            <h3><b>Edit - <?php echo $fruit['name'] ?></b></h3>
            <div class="col-6 card mt-4 mb-4">
            <form action="edit-product.php" method="post">
                <div class="card-body">
                        <div class="form-group mt-2">
                            <label for="name" class="fw-bold">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" value="<?php echo $fruit['name'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="quantity" class="fw-bold">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $fruit['quantity'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="uprice" class="fw-bold">Unit Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $fruit['price'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="uom" class="fw-bold">Unit of Measurement</label>
                            <input type="text" class="form-control" id="uom" name="uom" placeholder="Enter Unit of Measurement" value="<?php echo $fruit['uom'] ?>">
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary form-control" name="update">Save changes</button>
                </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<?php include('footer.php'); ?>