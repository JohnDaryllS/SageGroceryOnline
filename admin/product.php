<?php 

include('header.php'); 

$fruits = $db->query("SELECT * FROM tblproduct");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $uom = $_POST['uom'];
    $img = $_FILES['image'];


    $target_dir = "../assets/product-images/";
    $fileName = basename($_FILES["image"]["name"]);

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $targetFilePath = $target_dir . $fileName;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $sql = "INSERT INTO tblproduct (name,code,price,quantity,uom,image) VALUES ('$name','$code','$price','$quantity','$uom','product-images/$fileName')";
                $query_run = mysqli_query($db, $sql);

                if ($query_run) {
                    header('Location: product.php');
                } else {
                    $errorMessage = mysqli_error($db);
                    echo "<script>alert('Could Not Save Product Details: $errorMessage');</script>";
                    header('Location: customerorder.php');
                }
                
            }
        } else {
            echo "<script>alert('Could Not Save Product Details');</script>";
            header('Location: customer.php');
        }
    }
}

?>

<div class="container">
    <div class="row">
        <h1><b>Product</b></h1>
        <button type="button" class="btn btn-primary col-2" data-toggle="modal" data-target="#create">
            Create Product
        </button>
        <table class="table table-responsive mt-4 text-center">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($fruit = $fruits->fetch_assoc()) { ?>
                <tr>
                    <th scope="row" class="text-center" style="width:10%;">
                        <img src="../assets/<?php echo $fruit['image'] ?>" style="width: 60px; height:60px;" alt="<?php echo $fruit['name'] ?>">
                    </th>
                    <td>
                        <?php echo $fruit['name'] ?>
                    </td>
                    <td>PHP <?php echo $fruit['price'] ?> per <?php echo $fruit['uom'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit-product.php?id=<?php echo $fruit['id'];?>">Edit</a>
                        <a href="delete-product.php?id=<?php echo $fruit['id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="product.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Create Product</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="name" class="fw-bold">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="name" class="fw-bold">Product Code</label>
                            <input type="text" class="form-control" id="name" name="code" placeholder="Enter Product Code" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="quantity" class="fw-bold">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="price" class="fw-bold">Unit Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="uom" class="fw-bold">Unit of Measurement</label>
                            <input type="text" class="form-control" id="uom" name="uom" placeholder="Enter Unit of Measurement" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="img" class="fw-bold">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
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