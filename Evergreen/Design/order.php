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
    <title>Order</title>

    <!-- font awesome cdn start-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesome cdn end-->

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php include 'header.php'; ?>


<section class="placed-orders">

    <h1 class="heading"> placed order </h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>


    <!-- icons section start -->

    <section class="icons-container">

        <div class="icon">
            <img src="img/shipping.png" alt="">
            <div class="content">
                <h3>free shipping</h3>
                <p>get free shipping on order</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/cashback.png" alt="">
            <div class="content">
                <h3>100% money back</h3>
                <p>have 15 days to return</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/secure.png" alt="">
            <div class="content">
                <h3>payment secure</h3>
                <p>100% secure payment</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/24_7.png" alt="">
            <div class="content">
                <h3>24/7 support</h3>
                <p>contact us anytime</p>
            </div>
        </div>

    </section>

    <!-- icons section end -->




<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>