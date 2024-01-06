<?php

include('header.php');

$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"], 'uom' => $productByCode[0]["uom"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["code"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];


    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $itemprice = $_POST['itemprice'];
    $totalquantity = $_POST['totalquantity'];
    $totalprice = $_POST['totalprice'];

    $name = implode(',', $_POST['name']);
    $quantity = implode(',', $_POST['quantity']);
    $price = implode(',', $_POST['price']);

    $sql = "INSERT INTO user_order (user_id,firstname,lastname,email,address,phone,city,zip,totalquantity,totalprice,status)  VALUES ('$id','$firstname','$lastname','$email','$address','$phone','$city','$zip','$totalquantity','$totalprice','Pending')";
    $query_run = mysqli_query($db, $sql);
    $last_id = mysqli_insert_id($db);
    if ($query_run) {
        $sql2 = "INSERT INTO item_order (order_id,item_name,quantity,price,user_id)  VALUES ('$last_id','" . $name . "','" . $quantity . "','" . $price . "','$id')";
        $query_run2 = mysqli_query($db, $sql2);
        if ($query_run2 == TRUE) {
            header('Location: checkout.php');
            unset($_SESSION["cart_item"]);
        } else {
            echo "<script>alert('Could Not Save Product Details');</script>";
        }
    } else {
        echo "<script>alert('Could Not Save Product Details');</script>";
    }
}
?>
<div class="container mb-4">
    <h1><b>Shopping Basket</b></h1>
    <?php if (isset($_SESSION["cart_item"])) {
        $total_quantity = 0;
        $total_price = 0;
    ?>
        <?php if (!isset($_SESSION['username'])) { ?>
            <form action="shopping-basket.php" method="post">
            <div class="row">
                <p>Already a Member? Login <a href="../login.php">here</a></p>
                <div class="col-6">
                        <a id="btnEmpty" class="btn btn-primary" href="shopping-basket.php?action=empty">Empty Cart</a>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($_SESSION["cart_item"] as $item) {
                                        $item_price = $item["quantity"] * $item["price"];
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="../assets/<?php echo $item["image"]; ?>" style="width: 30px; height:30px;" />
                                                <input type="hidden" name="name[]" value="<?php echo $item["name"]; ?>">
                                                <?php echo $item["name"]; ?>
                                            </td>
                                            <td>
                                                <input type="hidden" name="quantity[]" value="<?php echo $item["quantity"]; ?>">
                                                <?php echo $item["quantity"]; ?> <?php echo $item["uom"]; ?>
                                            </td>
                                            <td>
                                                <input type="hidden" name="price[]" value="<?php echo "$ " . $item["price"]; ?>">
                                                <?php echo "$ " . $item["price"]; ?>
                                            </td>
                                            <td>
                                                <input type="hidden" name="itemprice[]" value="<?php echo "$ " . number_format($item_price, 2); ?>">
                                                <?php echo "$ " . number_format($item_price, 2); ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="shopping-basket.php?action=remove&code=<?php echo $item["code"]; ?>">
                                                    <img src="../assets/icons/icon-delete.png" alt="Remove Item" />
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["price"] * $item["quantity"]);
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2" align="right">Total:</td>
                                        <td align="right">
                                            <input type="hidden" name="totalquantity" value="<?php echo $total_quantity; ?>">
                                            <?php echo $total_quantity; ?>
                                        </td>
                                        <td align="right" colspan="2">
                                            <input type="hidden" name="totalprice" value="<?php echo "$ " . number_format($total_price, 2); ?>">
                                            <strong><?php echo "$ " . number_format($total_price, 2); ?></strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="card col-lg-12">
                            <div class="card-body">
                                    <h3 class="text-center"><b>Contact Information</b></h3>
                                    <div class="form-group mt-2">
                                        <label for="email" class="fw-bold">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mt-2">
                                                <label for="password" class="fw-bold">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mt-2">
                                                <label for="confirmpassword" class="fw-bold">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                                                    placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mt-2">
                                                <label for="firstname" class="fw-bold">Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mt-2">
                                                <label for="lastname" class="fw-bold"></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="phone" class="fw-bold">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="address" class="fw-bold">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="city" class="fw-bold">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="zipcode" class="fw-bold">Zip Code</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code" required>
                                    </div>
                                    <button type="submit" name="submit" class="mt-4 btn btn-success form-control">Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } else {
            $rows = $db->query("SELECT * FROM users WHERE id='$_SESSION[id]'"); ?>
            <a id="btnEmpty" class="btn btn-primary" href="shopping-basket.php?action=empty">Empty Cart</a>
            <form action="shopping-basket.php" method="post">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Code</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">UOM</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION["cart_item"] as $item) {
                            $item_price = $item["quantity"] * $item["price"];
                        ?>
                            <tr>
                                <td>
                                    <img src="../assets/<?php echo $item["image"]; ?>" style="width: 30px; height:30px;" />
                                    <input type="hidden" name="name[]" value="<?php echo $item["name"]; ?>">
                                    <?php echo $item["name"]; ?>
                                </td>
                                <td>
                                    <?php echo $item["code"]; ?>
                                </td>
                                <td>
                                    <input type="hidden" name="quantity[]" value="<?php echo $item["quantity"]; ?>">
                                    <?php echo $item["quantity"]; ?>
                                </td>
                                <td>
                                    <?php echo $item["uom"]; ?>
                                </td>
                                <td>
                                    <input type="hidden" name="price[]" value="<?php echo "$ " . $item["price"]; ?>">
                                    <?php echo "$ " . $item["price"]; ?>
                                </td>
                                <td>
                                    <input type="hidden" name="itemprice[]" value="<?php echo "$ " . number_format($item_price, 2); ?>">
                                    <?php echo "$ " . number_format($item_price, 2); ?>
                                </td>
                                <td class="text-center">
                                    <a href="shopping-basket.php?action=remove&code=<?php echo $item["code"]; ?>">
                                        <img src="../assets/icons/icon-delete.png" alt="Remove Item" />
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $total_quantity += $item["quantity"];
                            $total_price += ($item["price"] * $item["quantity"]);
                        }
                        ?>
                        <tr>
                            <td colspan="2" align="right">Total:</td>
                            <td align="right">
                                <input type="hidden" name="totalquantity" value="<?php echo $total_quantity; ?>">
                                <?php echo $total_quantity; ?>
                            </td>
                            <td align="right" colspan="2">
                                <input type="hidden" name="totalprice" value="<?php echo "$ " . number_format($total_price, 2); ?>">
                                <strong><?php echo "$ " . number_format($total_price, 2); ?></strong>
                            </td>
                            <td></td>
                        </tr>
                        <?php while ($row = $rows->fetch_assoc()) { ?>
                            <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                            <input type="hidden" name="email" value="<?php echo $row["email"] ?>">
                            <input type="hidden" name="firstname" value="<?php echo $row["firstname"] ?>">
                            <input type="hidden" name="lastname" value="<?php echo $row["lastname"] ?>">
                            <input type="hidden" name="phone" value="<?php echo $row["phone"] ?>">
                            <input type="hidden" name="address" value="<?php echo $row["address"] ?>">
                            <input type="hidden" name="city" value="<?php echo $row["city"] ?>">
                            <input type="hidden" name="zip" value="<?php echo $row["zipcode"] ?>">
                        <?php } ?>
                    </tbody>
                </table>
                <button type="submit" name="submit" class="btn btn-success form-control">Checkout</button>
            </form>
        <?php } ?>
    <?php } else { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="fw-bold text-center">No Items on your cart</h3>
            </div>
        </div>
    <?php } ?>
</div>

<?php include('footer.php'); ?>