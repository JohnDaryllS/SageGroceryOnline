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
?>
        <div class="container mb-4">
            <h1><b>Fruits</b></h1>
            <?php
            if (isset($_SESSION["cart_item"])) {
                $total_quantity = 0;
                $total_price = 0;
            ?>
            <a id="btnEmpty" class="btn btn-danger" href="fruits.php?action=empty">Empty Cart</a>
            <a id="btnCheckout" class="btn btn-primary" href="shopping-basket.php">Checkout</a>
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
                                <td><img src="../assets/<?php echo $item["image"]; ?>" style="width: 30px; height:30px;" /><?php echo $item["name"]; ?></td>
                                <td><?php echo $item["code"]; ?></td>
                                <td><?php echo $item["quantity"]; ?></td>
                                <td><?php echo $item["uom"]; ?></td>
                                <td><?php echo "$ " . $item["price"]; ?></td>
                                <td><?php echo "$ " . number_format($item_price, 2); ?></td>
                                <td class="text-center">
                                    <a href="fruits.php?action=remove&code=<?php echo $item["code"]; ?>">
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
                            <td align="right"><?php echo $total_quantity; ?></td>
                            <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        <div class="container mb-4">
            <div class="row">
                <?php
                $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
                if (!empty($product_array)) {
                    foreach ($product_array as $key => $value) {
                ?>
                        <div class="col-3 mt-2" >
                            <div class="card mb-2">
                                <form action="fruits.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" method="post">
                                    <div class="card-header text-center">
                                        <img class="img-fluid" style="width: 100px; height:100px;" src="../assets/<?php echo $product_array[$key]["image"]; ?>" alt="<?php echo $product_array[$key]["name"]; ?>">
                                    </div>
                                    <div class="card-body" >
                                        <p class="fw-bold"><?php echo $product_array[$key]["name"]; ?></p>
                                        <div class="row">
                                            <div class="col-6">
                                                <p><?php echo "$" . $product_array[$key]["price"]; ?></p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" name="quantity" class="form-control" value="1" size="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group">
                                            <input type="submit" class="form-control btn btn-primary" value="Add to Cart">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>

        <?php include('footer.php'); ?>