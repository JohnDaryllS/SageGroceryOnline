<?php

include('header.php');

$searchErr = '';
$fruit_details='';
$data = '';
if(isset($_POST['save']))
{
	if(!empty($_POST['search']))
	{
		$search = $_POST['search'];
        $stmt = $db->prepare("SELECT * FROM tblproduct WHERE name like '%$search%'");
		$stmt->execute();

        $resultSet = $stmt->get_result();
        $data = $resultSet->fetch_all(MYSQLI_ASSOC);
	}
	else
	{
		$searchErr = "Please enter the information";
	}

}

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

<div class="container">
    <h1><b>Search</b></h1>
    <div class="row mt-4">
        <form class="d-flex" action="#" method="post">
            <p>Search for Products</p>
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit" name="save">Go</button>
        </form>
    </div>
    <hr>
    <div class="row mt-4 mb-4">
        <h3><b>Search Results:</b></h3>
        <?php if(!$data)
        {
            echo '
            <div class="card">
                <div class="card-body text-center">
                    <h4><b>No fruit with that name</b></h4>
                </div>
            </div>'
            ;
            } else { foreach($data as $key=>$value) { ?>
                        <div class="col-3">
                            <div class="card mb-2">
                                <form action="shopping-basket.php?action=add&code=<?php echo $value['code'];?>" method="post">
                                    <div class="card-header text-center">
                                        <img class="img-fluid" src="../assets/<?php echo $value['image'];?>" style="width: 150px; height:150px;" alt="<?php echo $product_array[$key]["name"]; ?>">
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $value['name'];?></p>
                                        <div class="row">
                                            <div class="col-6">
                                                <p><?php echo $value['price'];?></p>
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