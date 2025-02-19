<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="dashboard">

    <h1 class="title">dashboard</h1>

    <div class="box-container">

        <div class="box">
            <?php
                $total_pendings = 0;
                $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_pendings->execute(['pending']);
                while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                    $total_pendings += $fetch_pendings['total_price'];
                };
            ?>
            <h3>₹<?= $total_pendings; ?>/-</h3>
            <p>Total pendings</p>
            <a href="admin_order.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
                $total_completed = 0;
                $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_completed->execute(['completed']);
                while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
                    $total_completed += $fetch_completed['total_price'];
                };
            ?>
            <h3>₹<?= $total_completed; ?>/-</h3>
            <p>Completed orders</p>
            <a href="admin_order.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $number_of_orders = $select_orders->rowCount();
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>orders placed</p>
            <a href="admin_order.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount();
            ?>
            <h3><?= $number_of_products; ?></h3>
            <p>Products added</p>
            <a href="admin_product.php" class="btn">see products</a>
        </div>

        <div class="box">
            <?php
                $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_users->execute(['user']);
                $number_of_users = $select_users->rowCount();
            ?>
            <h3><?= $number_of_users; ?></h3>
            <p>Total users</p>
            <a href="admin_user.php" class="btn">see accounts</a>
        </div>

        <div class="box">
            <?php
                $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_admins->execute(['admin']);
                $number_of_admins = $select_admins->rowCount();
            ?>
            <h3><?= $number_of_admins; ?></h3>
            <p>Total admins</p>
            <a href="admin_user.php" class="btn">see accounts</a>
        </div>

        <div class="box">
            <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                $number_of_accounts = $select_accounts->rowCount();
            ?>
            <h3><?= $number_of_accounts; ?></h3>
            <p>Total accounts</p>
            <a href="admin_user.php" class="btn">see accounts</a>
        </div>

        <div class="box">
            <?php
                $select_messages = $conn->prepare("SELECT * FROM `message`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount();
            ?>
            <h3><?= $number_of_messages; ?></h3>
            <p>Total feedback</p>
            <a href="admin_contact.php" class="btn">see feedback</a>
        </div>

    </div>

</section>


<script src="admin_script.js"></script>

</body>
</html>