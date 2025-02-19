<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
    $delete_message->execute([$delete_id]);
    header('location:admin_contact.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="messages">

    <h1 class="title">feedback</h1>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <th>user id</th>
                <th>name</th>
                <th>number</th>
                <th>email</th>
                <th>message</th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM message";
                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if($result){
                        foreach($result as $row){
                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['number']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['message']; ?></td>
                                <td><a href="admin_contact.php?delete=<?= $row['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a></td>
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