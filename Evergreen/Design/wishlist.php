<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $p_name = $_POST['p_name'];
    $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
    $p_price = $_POST['p_price'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
    $p_image = $_POST['p_image'];
    $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
    $p_qty = $_POST['p_qty'];
    $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);

    if($check_cart_numbers->rowCount() > 0){
        $message[] = 'already added to cart!';
    }
    else{

        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

        if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$p_name, $user_id]);
        }

        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
        $message[] = 'product added to cart!';
    }


}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
    $delete_wishlist_item->execute([$delete_id]);
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){

    $delete_all = $_GET['delete_all'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist_item->execute([$user_id]);
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <!-- font awesome cdn start-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesome cdn end-->

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>


<section class="wishlist">

    <h1 class="heading"> Wish-list </h1>

    <div class="box-container">

    <?php
        $grand_total = 0;
        $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $select_wishlist->execute([$user_id]);
        if($select_wishlist->rowCount() > 0){
            while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
    ?>
    <form class="box" method="post" enctype="multipart/form-data">
        <div class="icon">
            <a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
            <a href="wishlist.php?delete=<?= $fetch_wishlist['id']; ?>" class="fa-solid fa-trash" onclick="return confirm('delete product from wishlist?');"></a>
        </div>
        <img src="img/<?= $fetch_wishlist['image']; ?>">
        <div class="name"><?= $fetch_wishlist['name']; ?></div>
        <input type="hidden" name="pid" value="<?= $fetch_wishlist['id']; ?>">
        <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
        <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price']; ?>">
        <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
        </div>
            <span>quantity : </span>
            <input type="number" min="1" max="50" value="1" name="p_qty" class="qty">
        <div class="price">₹<?= $fetch_wishlist['price']; ?>/-</div>
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>
    <?php
            $grand_total += $fetch_wishlist['price'];
            }
        }
        else{
            echo '<p class="empty">your wishlist is empty!</p>';
        }
    ?>

    </div>

    <div class="wishlist-total">
        <p>grand total : <span>₹<?= $grand_total; ?>/-</span></p>
        <a href="product.php" class="option-btn">continue to shopping</a>
        <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all wishlist</a>
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