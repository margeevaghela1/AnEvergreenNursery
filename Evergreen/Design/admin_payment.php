<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_tra = $conn->prepare("DELETE FROM `transactions` WHERE id = ?");
    $delete_tra->execute([$delete_id]);
    header('location:admin_payment.php');
 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin payment</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="user-accounts">

    <h1 class="title">credit card details</h1>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <th>name</th>
                <th>card number</th>
                <th>expiration date</th>
                <th>cvv</th>
                <th>transaction date</th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM transactions";
                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if($result){
                        foreach($result as $row){
                            ?>
                            <tr>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['card_number']; ?></td>
                                <td><?= $row['expiration_date']; ?></td>
                                <td><?= $row['cvv']; ?></td>
                                <td><?= $row['transaction_date']; ?></td>
                                <td><a href="admin_payment.php?delete=<?= $row['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td colspan="7" class="no-data">'No record found!'</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>

    </div>

</section>


<script src="admin_script.js"></script>

</body>
</html>