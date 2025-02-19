<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    
<section class="product" id="product">

<h1 class="heading"> new products </h1>

<div class="box-container">

    <?php
        $select_products =$conn->prepare("SELECT * FROM `products` LIMIT 6");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
    ?>

    <form class="box" method="post" enctype="multipart/form-data">
        <div class="icon">
            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
        </div>
        <img src="img/<?= $fetch_products['image']; ?>">
        <div class="name"><?= $fetch_products['name']; ?></div>
        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
        <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
        <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
        <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
        </div>
        <div class="quantity">
            <span>quantity : </span>
            <input type="number" min="1" value="1" name="p_qty" class="qty">
        </div>
        <div class="price">₹<?= $fetch_products['price']; ?>/-</div>
        <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>

    <?php
            }
        }
        else{
            echo '<p class="empty">no products added yet</p>';
        }
    ?>

</div>

</body>
</html>