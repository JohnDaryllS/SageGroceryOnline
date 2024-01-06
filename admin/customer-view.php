<?php
include('header.php');

$customer_id = isset($_GET['id']) ? $_GET['id'] : null;

$customer_query = $db->prepare("SELECT * FROM users WHERE id = ? AND usertype = 'user'");
$customer_query->bind_param("i", $customer_id);
$customer_query->execute();
$customer_result = $customer_query->get_result();

if ($customer_result->num_rows > 0) {
    $customer = $customer_result->fetch_assoc();
?>
    <div class="container">
        <div class="row">
            <h3><b>Customer Details</b></h3>
            <table class="table table-responsive text-center">
                <tbody>
                    <tr>
                        <th scope="row">Account Name</th>
                        <td><?php echo $customer['username']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">First Name</th>
                        <td><?php echo $customer['firstname']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Last Name</th>
                        <td><?php echo $customer['lastname']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $customer['email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td><?php echo $customer['phone']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Address</th>
                        <td><?php echo $customer['address']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">City</th>
                        <td><?php echo $customer['city']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Zip Code</th>
                        <td><?php echo $customer['zipcode']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
    echo "<p>Customer not found</p>";
}

include('footer.php');
?>
