<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $p_name = $_POST['p_name'];
    $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
    $p_price = $_POST['p_price'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
    $p_image = $_POST['p_image'];
    $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

    $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
    $check_wishlist_numbers->execute([$p_name, $user_id]);

    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);

    if($check_wishlist_numbers->rowCount() > 0){
        $message[] = 'already added to wishlist!';
    }
    elseif($check_cart_numbers->rowCount() > 0){
        $message[] = 'already added to cart!';
    }
    else{
        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
        $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
        $message[] = 'product added to wishlist!';
    }


}

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


};

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $mesg = $_POST['mesg'];
    $mesg = filter_var($mesg, FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->execute([$name,  $email, $number, $mesg]);

    if($select_message->rowCount() > 0){
        $message[] = 'already sent message';
    }else
    {
        $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
        $insert_message->execute([$user_id, $name, $email, $number, $mesg]);
        $message[] = 'sent message successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>

    <!-- swipper cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- end swipeer link -->

    <!-- font awesome cdn start-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesome cdn end-->

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <!-- header section start -->

    <?php include 'header.php'; ?>

    <!-- header section end -->


    <!-- Home section start -->

    <section class="home" id="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider1.jpg);">
                        <div class="content">
                            <span>upto 70% less price</span>
                            <h3>Plant at special price</h3>
                            <a href="product.php" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider2.jpg);">
                        <div class="content">
                            <span>upto 40% less price</span>
                            <h3>Buy your dream plants</h3>
                            <a href="product.php" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider3.jpg);">
                        <div class="content">
                            <span>upto 65% less price</span>
                            <h3>decore your home now</h3>
                            <a href="product.php" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <!-- Home section end -->



    <!-- banner section start -->

    <!-- <section class="banner-container">

        <div class="banner">
            <img src="img/banner1.jpg">
            <div class="content">
                <span>new arrivals</span>
                <h3>House plant</h3>
                <a href="#" class="btn">Shop now!</a>
            </div>
        </div>
        <div class="banner">
            <img src="img/banner2.jpg">
            <div class="content">
                <span>new arrivals</span>
                <h3>office plant</h3>
                <a href="#" class="btn">Shop now!</a>
            </div>
        </div>

    </section> -->

    <!-- banner section end -->



    <?php

if(isset($_POST['search_btn'])){

?>

<section class="search-product" id="product" style="padding-top: 0;">

    <h1 class="heading"> search products </h1>

    <div class="box-container">

        <?php
            $search_box = $_POST['search_box'];
            $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
            $select_products =$conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%'");
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
                <span>quantity : </span>
                <input type="number" min="1" value="1" name="p_qty" class="qty">
            <div class="price">₹<?= $fetch_products['price']; ?>/-</div>
            <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
        </form>

        <?php
                }
            }
            else{
                echo '<p class="empty">no result found!</p>';
            }
        ?>

    </div>

</section>

<?php

};
?>



    <!-- category section start -->

    <section class="category" id="category">

        <h1 class="heading"> Shop by category </h1>

        <div class="box-container">

            <div class="box">
                <img src="img/bonsai.jpg">
                <div class="content">
                    <h3>Bonsai</h3>
                    <a href="category.php?category=bonsai" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/fertilizer.jpg">
                <div class="content">
                    <h3>fertilizer</h3>
                    <a href="category.php?category=fertilizer" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/flower.jpg">
                <div class="content">
                    <h3>Flower</h3>
                    <a href="category.php?category=flower" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/plant.jpg">
                <div class="content">
                    <h3>plants</h3>
                    <a href="category.php?category=plants" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/seed.jpg">
                <div class="content">
                    <h3>seeds</h3>
                    <a href="category.php?category=seeds" class="btn">Explore!</a>
                </div>
            </div>

        </div>

    </section>

    <!-- category section end -->



    <!-- product section start -->

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
                    <span>quantity : </span>
                    <input type="number" min="1" max="50" value="1" name="p_qty" class="qty">
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

    </section>

    <!-- product section end -->

                

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



    <!-- contact us section start -->

    <section class="contact" id="contact">

        <h1 class="heading">get in touch</h1>

        <div class="row">

            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d917.8095211986612!2d72.54225537135702!3d23.051731409647164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e851c0926ecab%3A0xc08bfe621d2551ac!2sSHRADDHA%20NURSERY!5e0!3m2!1sen!2sin!4v1705949362893!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            
            <form action="" method="post">

                <div class="inputbox">
                    <input type="text" name="name" required>
                    <label>name</label>
                </div>
                <div class="inputbox">
                    <input type="email" name="email" required>
                    <label>email</label>
                </div>
                <div class="inputbox">
                    <input type="number" name="number" required>
                    <label>number</label>
                </div>
                <div class="inputbox">
                    <textarea required name="mesg" id="" cols="30" rows="10"></textarea>
                    <label>send feedback</label>
                </div>

                <input type="submit" value="send message" name="send" class="btn">

            </form>

        </div>

    </section>

    <!-- contact us section end -->



    <!-- footer section start -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h1>About us</h1>
                <p>We are providing different varietie of plants, seeds, fertilizers & many more to come…</p>
            </div>
            <div class="box">
                <h1>Extra links</h1>
                <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
                <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
                <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
                <a href="signup.php"> <i class="fas fa-angle-right"></i> signup</a>
            </div>
            <div class="box">
                <h1>quick links</h1>
                <a href="home_page.php"> <i class="fas fa-angle-right"></i> home</a>
                <a href="#category"> <i class="fas fa-angle-right"></i> category</a>
                <a href="#product"> <i class="fas fa-angle-right"></i> product</a>
                <a href="order.php"> <i class="fas fa-angle-right"></i> order</a>
                <a href="#contact"> <i class="fas fa-angle-right"></i> contact</a>
            </div>
            <div class="box">
                <h1>follow us!</h1>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
                <a href="#">twitter</a>
                <a href="#">linkedin</a>
            </div>

        </div>

        <h1 class="credit"> created by <span> EverGreen Nursery </span> <br> &copy; copyright @<?= date('Y'); ?> | all rights reserved! </h1>

    </section>

    <!-- footer section end -->

    <!-- scroll top button -->

    <a href="#home" class="scroll-top fas fa-angle-up"></a>

    <!-- scroll top button end -->







    

    <!-- swipper js cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- swipper cdn end -->


    <!-- javascript file link -->
    <script src="script.js"></script>

    

</body>
</html>