<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['update_order'])) {

    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
    $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_orders->execute([$update_payment, $order_id]);
    $message[] = 'payment has been updated!';
};

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_orders->execute([$delete_id]);
    header('location:admin_order.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>


    <section class="placed-orders">
        <h1 class="title">order details</h1>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>User ID</th>
                    <th>Placed On</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Address</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>status</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    if ($select_orders->rowCount() > 0) {
                        while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <tr>
                                <td><?= $fetch_orders['user_id']; ?></td>
                                <td><?= $fetch_orders['placed_on']; ?></td>
                                <td><?= $fetch_orders['name']; ?></td>
                                <td><?= $fetch_orders['email']; ?></td>
                                <td><?= $fetch_orders['number']; ?></td>
                                <td><?= $fetch_orders['address']; ?></td>
                                <td><?= $fetch_orders['total_products']; ?></td>
                                <td>₹<?= $fetch_orders['total_price']; ?>/-</td>
                                <td><?= $fetch_orders['method']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                        <select name="update_payment" class="drop-down" <?= $fetch_orders['payment_status'] == 'completed' ? 'disabled' : '' ?>>
                                            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                </td>
                                <td>
                                    <div class="flex-btn">
                                        <input type="submit" name="update_order" class="option-btn" value="Update" <?= $fetch_orders['payment_status'] == 'completed' ? 'disabled' : '' ?>>
                                        <a href="admin_order.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="10" class="empty">No orders placed</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </section>


    <script src="admin_script.js"></script>

</body>

</html>
