<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_users->execute([$delete_id]);
    header('location:admin_user.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="user-accounts">

    <h1 class="title">user accounts</h1>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <th>id</th>
                <th>user name</th>
                <th>email</th>
                <th>password</th>
                <th>user type</th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM users";
                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if($result){
                        foreach($result as $row){
                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['password']; ?></td>
                                <td><span style=" color:<?php if($row['user_type'] == 'admin'){ echo 'blue'; }; ?>"><?= $row['user_type']; ?></span></td>
                                <td><a href="admin_user.php?delete=<?= $row['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td colspan="6" class="no-data">'No record found!'</td>
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