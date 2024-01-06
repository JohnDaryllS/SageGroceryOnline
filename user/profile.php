<?php

include('header.php');

if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zipcode'];

    $query = "UPDATE users SET email = '$email', firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address', city = '$city', zipcode = '$zip' WHERE id = '$_SESSION[id]'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        header('Location: ../user/profile.php');
    } else {
        header('Location: ../user/home.php');
    }
}

?>
<div class="container">
    <div class="row d-flex justify-content-center mb-4 mt-4">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <?php while ($row = $rows->fetch_assoc()) { ?>
                    <form action="profile.php" method="post">
                        <h3 class="text-center"><b><?php echo $row["firstname"] ?>'s Profile Account</b></h3>
                        <div class="form-group mt-2">
                            <label for="email" class="fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row["email"] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mt-2">
                                    <label for="firstname" class="fw-bold">Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First" value="<?php echo $row["firstname"] ?>"  required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mt-2">
                                    <label for="lastname" class="fw-bold"></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last" value="<?php echo $row["lastname"] ?>"  required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone" class="fw-bold">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $row["phone"] ?>"  required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="address" class="fw-bold">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $row["address"] ?>"  required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="city" class="fw-bold">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="<?php echo $row["city"] ?>"  required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="zipcode" class="fw-bold">Zip Code</label> 
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code" value="<?php echo $row["zipcode"] ?>"  required>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="text-center mt-2">
                                    <button type="submit" name="update" class="btn btn-success form-control justify-content-center">Submit</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center mt-2">
                                    <button type="#" class="btn btn-danger form-control justify-content-center">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>